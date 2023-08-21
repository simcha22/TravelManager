<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightCompany extends Model
{
    use HasFactory;

    protected $table = 'flight_companies';

    protected $fillable = [
        'name',
        'code',
    ];
}
