<?php

namespace App\Http\Crud\Product;

use App\Http\Crud\Config;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ListConfig extends Config
{
    protected string $name = 'products';
    protected array $columns = [
        'name',
        'tag',
        'description',
        'features',
        'screenshot',
        'promo',
        'is_active',
        'external_link',
    ];

    public function query(?Model $model = null)
    {
        return Product::all();
    }
}
