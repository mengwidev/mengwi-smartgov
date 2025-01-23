<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLogModel extends Model
{
    use HasFactory;

    protected $table = 'stock_logs';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnitModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stockLog) {
            // Automatically set the logged-in user's ID
            if (auth()->check()) {
                $stockLog->user_id = auth()->id();
            }

            // Generate log_id if it's empty
            if (empty($stockLog->log_id)) {
                $categoryId = $stockLog->product->category_id ?? 0; // Assuming Product has a category_id
                $timestamp = now()->format('Ymd');
                $dailyCount =
                    StockLogModel::whereDate(
                        'created_at',
                        now()->toDateString()
                    )->count() + 1;
                $logPrefix = strtoupper($stockLog->type[0]); // "I" for "in", "O" for "out"

                $stockLog->log_id = sprintf(
                    '%s/%d/%s/%04d',
                    $logPrefix,
                    $categoryId,
                    $timestamp,
                    $dailyCount
                );
            }
        });
    }
}
