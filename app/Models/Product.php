<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'tag',
        'description',
        'features',
        'screenshot',
        'promo',
        'is_active',
        'external_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
