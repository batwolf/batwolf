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
    protected ?Config $relatedConfig;

    public function __construct(?Model $model = null)
    {
        $this->data = $this->query($model);
        if (method_exists($this, 'relatedConfig')) {
            $config = $this->relatedConfig();
            $this->relatedConfig = new $config();
        }
    }

    protected abstract function query(?Model $model = null);

    public function toArray(): array
    {
        return [
          'data' => $this->data,
          'columns' => $this->columns,
          'name' => $this->name,
          'postRoute' => $this->postRoute ?? '',
          'relatedConfig' => $this->relatedConfig ?? null,
        ];
    }
}
