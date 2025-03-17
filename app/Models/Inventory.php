<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'sku', 'product_name', 'quantity', 'cost_price', 'additional_cost', 'total_amount', 'discount', 'grand_total','product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
