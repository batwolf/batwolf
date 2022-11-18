<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'screenshot_image',
        'promo_image',
        'external_link',
        'tags'
    ];
}
