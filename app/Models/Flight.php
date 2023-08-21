<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'travel_id',
        'flight_company_id',
        'airport_from_id',
        'airport_to_id',
        'start_time',
        'end_time',
        'type',
        'place',
        'user_id'
    ];

    public function travel() : BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    public function flightCompany() : BelongsTo
    {
        return $this->belongsTo(FlightCompany::class);
    }

    public function airportFrom() : BelongsTo
    {
        return $this->belongsTo(Airport::class, 'airport_from_id', 'id');
    }

    public function airportTo() : BelongsTo
    {
        return $this->belongsTo(Airport::class, 'airport_to_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
