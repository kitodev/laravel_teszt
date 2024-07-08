<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'name',
        'sex',
        'email',
        'phone',
        'age',
        'country',
        'shipping_method'
    ];

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function countryRelation()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    public function shippingMethod()
    {
        return $this->hasOne(ShippingMethod::class, 'id', 'shipping_method');
    }
}
