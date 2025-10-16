<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferImages extends Model
{
    protected $table = 'offer_images';
    public $timestamps = false;
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            if ($image->image_url_orig) {
                Storage::disk('s3')->delete(parse_url($image->image_url_orig, PHP_URL_PATH));
            }
            if ($image->image_url_small) {
                Storage::disk('s3')->delete(parse_url($image->image_url_small, PHP_URL_PATH));
            }
            if ($image->image_url_large) {
                Storage::disk('s3')->delete(parse_url($image->image_url_large, PHP_URL_PATH));
            }
        });
    }
}
