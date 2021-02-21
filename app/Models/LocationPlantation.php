<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationPlantation extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'coordinate'
    ];
}
