<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iata_code',
        'icao_code',
        'location',
        'postal_code',
        'phone',
        'latitude',
        'longitude',
        'uct',
        'website',
        'country_id',
        'city_id',
    ];

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
