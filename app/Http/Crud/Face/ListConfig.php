<?php

namespace App\Http\Crud\Face;

use App\Http\Crud\Config;
use App\Models\Face;
use Illuminate\Database\Eloquent\Model;

class ListConfig extends Config
{
    protected string $name = 'faces';
    protected array $columns = [
        'id',
        'name',
        'created'
    ];

    public function query(?Model $face = null)
    {
        return Face::all()->each(function($face) {
            $face['created'] = $face['created_at']->format('Y-m-d H:i:s');
        });
    }
}
