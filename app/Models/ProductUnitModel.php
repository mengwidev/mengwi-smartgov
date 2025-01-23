<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUnitModel extends Model
{
    protected $table = 'product_units';

    protected $guarded = [];

    public function stockLog()
    {
        return $this->hasMany(StockLogModel::class);
    }
}
