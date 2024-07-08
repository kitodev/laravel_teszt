<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryShippingMethod extends Model
{
    protected $table = 'country_shipping_method';

    protected $fillable = [
        'country_id',
        'shipping_method_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'id');
    }
}
