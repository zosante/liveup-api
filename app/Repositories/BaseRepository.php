<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model $model
     */
    protected $model;

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getAll(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function first(array $columns = ['*'], bool $fail = false)
    {
        return $fail
            ? $this->model->firstOrFail($columns)
            : $this->model->first($columns);
    }

    public function firstOrFail(array $columns = ['*'])
    {
        return $this->first($columns, true);
    }

    public function findBy(array $attributes, array $columns = ['*'], bool $fail = false)
    {
        return $fail
            ? $this->model->where($attributes)->firstOrFail($columns)
            : $this->model->where($attributes)->first($columns);
    }

    public function findOrFail(array $attributes, array $columns = ['*'], bool $fail = false)
    {
        return $this->findBy($attributes, $columns, true);
    }

}
