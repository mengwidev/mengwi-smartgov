<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'unit_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategoryModel::class);
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnitModel::class, 'unit_id');
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLogModel::class);
    }

    public function currentStock()
    {
        return $this->hasOne(StockLogModel::class, 'product_id')
            ->selectRaw(
                'product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as stock'
            )
            ->groupBy('product_id');
    }
}
