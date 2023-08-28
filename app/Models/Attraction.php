<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attraction extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = [
        'name',
        'opening_time',
        'closing_time',
        'preferred_visiting_day',
        'preferred_visiting_time',
        'visiting_hours',
        'description',
        'city_id',
        'user_id',
        'travel_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function experience(): HasMany
    {
        return $this->hasMany(Experience::class);
    }
}
