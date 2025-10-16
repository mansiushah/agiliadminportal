<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeZoneName extends Model
{
    protected $connection = 'mysql_system';   // 👈 use system DB
    protected $table = 'time_zone_name';      // 👈 actual table name
    public $timestamps = false;               // system table has no timestamps
}
