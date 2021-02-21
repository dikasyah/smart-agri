<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BASE_TABLE extends Model
{
    use HasFactory;

    protected $table = 'BASE_TABLE';

    protected $fillable = [
        'TABLE_CATALOG','TABLE_SCHEMA','TABLE_NAME','TABLE_TYPE'
    ];

    public $timestamps = false;
}
