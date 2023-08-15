<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'count_of_users',
        'count_of_groups',
        'count_of_travels',
        'count_of_advertisements',
        'count_of_tracks',
        'count_of_documents',
        'type_of_calk',
        'status',
    ];
}
