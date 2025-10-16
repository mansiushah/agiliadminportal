<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKeyUsage extends Model
{
    protected $table = 'api_key_usage';
    public $timestamps = false;
}
