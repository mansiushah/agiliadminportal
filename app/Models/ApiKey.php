<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $table = 'api_key';
    public $timestamps = false; 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
