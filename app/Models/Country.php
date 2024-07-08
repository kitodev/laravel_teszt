<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    
    protected $fillable = [
        'name'
    ];

    public function countryShippingMethod()
    {
        return $this->hasMany(CountryShippingMethod::class, 'country_id', 'id');
    }
}
