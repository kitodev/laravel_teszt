<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    
    protected $fillable = [
        'order_id',
        'product_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id', '=');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
