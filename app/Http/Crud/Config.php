<?php

namespace App\Http\Crud;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

abstract class Config implements Arrayable
{
    protected $data;
    protected array $columns;
    protected string $name;
    protected string $postRoute;

    public function __construct(?Model $model = null)
    {
        $this->data = $this->query($model);
    }

    public abstract function query(?Model $model = null);

    public function getColumns(string $name = null): array
    {
        if (!empty($name)) {
            return $this->columns[$name];
        }

        return $this->columns;
    }

    public function getData()
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return [
          'data' => $this->data,
          'columns' => $this->columns,
          'name' => $this->name,
          'postRoute' => $this->postRoute ?? '',
        ];
    }
}
