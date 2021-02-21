<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BASE_SP extends Model
{
    use HasFactory;

    protected $table = 'BASE_SP';

    protected $fillable = [
        'name','id','xtype','uid','info','status','base_schema_ver','replinfo','parent_obj','crdate','ftcatid','schema_ver','stats_schema_ver','type','userstat','sysstat','indexdel','refdate','version','deltrig','instrig','updtrig','seltrig','category','cache','Source_DB'
    ];

    public $timestamps = false;
}
