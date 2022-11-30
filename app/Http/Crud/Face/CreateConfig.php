<?php

namespace App\Http\Crud\Face;

use App\Http\Crud\Config;
use App\Models\Face;
use Illuminate\Database\Eloquent\Model;

class CreateConfig extends Config
{
    protected string $name = 'faces';
    protected string $postRoute = 'faces.store';
    protected array $columns = [
        'name' => [
            'type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Name',
            'required' => 'required',
        ],
        'description' => [
            'type' => 'textarea',
            'label' => 'Description',
            'placeholder' => 'Description',
            'required' => 'required',
        ],
        'external_link' => [
            'type' => 'text',
            'label' => 'External Link',
            'placeholder' => 'External Link',
            'required' => 'required',
        ],
        'tags' => [
            'type' => 'text',
            'label' => 'Tags',
            'placeholder' => 'Tags',
            'required' => 'required',
        ],
        'screenshot_image' => [
            'type' => 'file',
            'label' => 'Screenshot',
            'placeholder' => 'Screenshot',
            'required' => 'required',
        ],
        'promo_image' => [
            'type' => 'file',
            'label' => 'Promo',
            'placeholder' => 'Promo',
            'required' => 'required',
        ],
    ];

    public function query(?Model $model = null)
    {
        $face = new Face();
        $face->forceFill([
            'name' => '',
            'description' => '',
            'external_link' => '',
            'tags' => '',
            'screenshot_image' => '',
            'promo_image' => '',
        ]);

        return $face;
    }
}
