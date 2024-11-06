<?php

namespace App\Repositories\Base;

use App\Repositories\Base\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    abstract public function getModel();

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function firstOrCreate($data = [], $attributes = [])
    {
        return $this->model->firstOrCreate($data, $attributes);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->model->find($id);
        if ($result) {
            return $result->update($attributes);
        };
        return false;
    }

    public function delete($id)
    {
        $result = $this->model->find($id);
        if ($result) {
            return $result->delete();
        };
        return false;
    }
}
