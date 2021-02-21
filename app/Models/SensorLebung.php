<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorLebung extends Model
{
    use HasFactory;

    protected $fillable = [
        'entry_id',
        'object_id',
        'sensor_id',
        'value',
        'date',
        'time'
    ];

    public $timestamps = false;
}
