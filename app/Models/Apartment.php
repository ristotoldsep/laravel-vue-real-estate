<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Apartment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'number',
        'floor',
        'rooms',
        'area',
        'balcony',
        'price',
        'status',
        'salePrice',
        'offer',
        'kulaliskorter',
        'hidden',
    ];

    protected $casts = [
        'salePrice' => 'integer',
        'price' => 'integer',
        'kulaliskorter' => 'boolean',
        'hidden' => 'boolean',
    ];

    public function getBalconyAttribute($value)
    {
        return $value == 0 ? "" : $value;
    }
}
