<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $table = 'shipping_method';

    protected $fillable = [
        'name'
    ];

    public function countryShippingMethod()
    {
        return $this->hasMany(CountryShippingMethod::class, 'shipping_method_id', 'id');
    }
}
