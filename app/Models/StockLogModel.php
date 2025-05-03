<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StockLogModel extends Model
{
    use HasFactory;

    protected $table = 'stock_logs';

    protected $fillable = [
        'log_id',
        'product_id',
        'type',
        'quantity',
        'date',
        'added_by'
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function unit()
    {
        return $this->belongsTo(EmploymentUnit::class, 'out_unit_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Creating a new record
        static::creating(function ($stockLog) {
            if (Auth::check()) {
                $stockLog->added_by = Auth::id();
            }

            if (empty($stockLog->log_id)) {
                $categoryId = $stockLog->product->category_id ?? 0;
                $timestamp = Carbon::parse($stockLog->date)->format('Ymd');

                // Count the stock movements based on type and date, not product
                $dailyCount =
                    StockLogModel::whereDate(
                        'date',
                        Carbon::parse($stockLog->date)->toDateString()
                    )
                    ->where('type', $stockLog->type) // Ensure count is by type (IN or OUT)
                    ->count() + 1; // Increment count for current log

                $logPrefix = strtoupper($stockLog->type);

                // Format the log_id with the sequence number
                $stockLog->log_id = sprintf(
                    '%s/%d/%s/%04d',
                    $logPrefix,
                    $categoryId,
                    $timestamp,
                    $dailyCount
                );
            }
        });

        // Updating an existing record
        static::updating(function ($stockLog) {
            if (
                $stockLog->isDirty('type') ||
                $stockLog->isDirty('product_id')
            ) {
                $categoryId = $stockLog->product->category_id ?? 0;
                $timestamp = Carbon::parse($stockLog->date)->format('Ymd');

                // Recalculate dailyCount based on type and date, excluding the current record
                $dailyCount =
                    StockLogModel::whereDate(
                        'date',
                        Carbon::parse($stockLog->date)->toDateString()
                    )
                    ->where('type', $stockLog->type) // Ensure count is by type (IN or OUT)
                    ->where('id', '!=', $stockLog->id) // Exclude the current record
                    ->count() + 1; // Increment count for current log

                $logPrefix = strtoupper($stockLog->type);

                // Generate the new log_id based on the calculated dailyCount
                do {
                    $log_id = sprintf(
                        '%s/%d/%s/%04d',
                        $logPrefix,
                        $categoryId,
                        $timestamp,
                        $dailyCount
                    );

                    // If the generated log_id already exists, increment the counter and try again
                    $dailyCount++;
                } while (StockLogModel::where('log_id', $log_id)->exists());

                // Set the updated log_id
                $stockLog->log_id = $log_id;
            } else {
                // Keep the original log_id if no relevant fields are updated
                $stockLog->log_id = $stockLog->getOriginal('log_id');
            }
        });
    }
}
