<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Traveler extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'user_id',
        'travel_id'
    ];


    public function travel() : BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
