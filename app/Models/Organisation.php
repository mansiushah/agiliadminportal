<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'organisations';
    public $timestamps = false;
    public function currencyName()
    {
        return $this->hasOne(Currencies::class,'id','currency_id'); // adjust to match your column name
    }
    public function userCount()
    {
        return $this->hasMany(User::class);
    }
    public function getCategoryNamesAttribute()
    {
        $ids = json_decode($this->category_id ?? '[]');
        return \App\Models\Category::whereIn('id', $ids)->pluck('name')->toArray();
    }
    public function users()
    {
        return $this->hasMany(User::class, 'organisation_id'); // adjust to match your column name
    }
    public function organisationtaxregistrationsm()
    {
        return $this->hasMany(OrganisationTaxRegistrations::class, 'organisation_id');
    }
}
