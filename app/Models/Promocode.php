<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promocode extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'promo_codes';
    public $timestamps = false; 
    protected $fillable=['promo_code','percentage_discount','environment','organisation_id','time_zone_name','expired_at'];
    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }
}
