<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'travels';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'start_time',
        'end_time',
        'count_of_travelers',
        'count_of_targets',
        'number_of_days',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function traveler(): HasMany
    {
        return $this->hasMany(Traveler::class);
    }

    public function destination(): HasMany
    {
        return $this->hasMany(Destination::class);
    }
}
