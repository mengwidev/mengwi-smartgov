<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ProductCategoryModel::class);
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLogModel::class);
    }

    public function currentStock()
    {
        return $this->hasMany(StockLogModel::class, 'product_id')
            ->selectRaw(
                'product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as stock'
            )
            ->groupBy('product_id');
    }
}
