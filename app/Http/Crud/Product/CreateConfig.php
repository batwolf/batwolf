<?php

namespace App\Http\Crud\Product;

use App\Http\Crud\Config;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class CreateConfig extends Config
{
    protected string $name = 'products';
    protected string $postRoute = 'products.store';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Name',
            'required' => 'required',
        ],
        'tag' => [
            'type' => 'text',
            'label' => 'Tag',
            'placeholder' => 'Tag',
            'required' => 'required',
        ],
        'external_link' => [
            'type' => 'text',
            'label' => 'External Link',
            'placeholder' => 'External Link',
            'required' => 'required',
        ],
        'description' => [
            'type' => 'textarea',
            'label' => 'Description',
            'placeholder' => 'Description',
            'required' => 'required',
        ],
        'features' => [
            'type' => 'textarea',
            'label' => 'Features',
            'placeholder' => 'Features',
            'required' => 'required',
        ],
        'screenshot' => [
            'type' => 'file',
            'label' => 'Screenshot',
            'placeholder' => 'Screenshot',
            'required' => 'required',
        ],
        'promo' => [
            'type' => 'file',
            'label' => 'Promo Image',
            'placeholder' => 'Promo Image',
            'required' => 'required',
        ],
        'is_active' => [
            'type' => 'checkbox',
            'label' => 'Is Active',
            'placeholder' => 'Is Active',
            'required' => 'required',
        ],
    ];

    public function query(?Model $model = null)
    {
        $product = new Product();
        $product->forceFill([
            'name' => '',
            'tag' => '',
            'description' => '',
            'features' => '',
            'screenshot' => '',
            'promo' => '',
            'is_active' => '',
            'external_link' => '',
        ]);

        return $product;
    }
}
