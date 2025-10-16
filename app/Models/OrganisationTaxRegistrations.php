<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationTaxRegistrations extends Model
{
    protected $table = 'organisation_tax_registrations';
    public $timestamps = false;
     protected $fillable = [
        'organisation_id',
        'stripe_tax_type',
        'tax_registration_number',
        'stripe_tax_id',
        'stripe_test_tax_id'
    ];
}
