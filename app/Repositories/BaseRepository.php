<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * Eloquent Model
     *
     * @var Model
     */
    protected $model;
    
    /**
     * Method __construct
     *
     * @param Model $model [explicite description]
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a specific resource
     *
     *
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Get all record
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * Get all record with some condition
     *
     * @param  array  $with
     * @return Collection
     */
    public function getAllWhere(array $where, $with = [])
    {
        return $this->model->with($with)->where($where)->get();
    }

    /**
     * Method update or create
     *
     *
     * @return bool
     */
    public function updateOrCreate(array $where, array $attributes)
    {
        return $this->model->updateOrCreate($where, $attributes);
    }

    /**
     * Method first or create
     *
     *
     * @return Model
     */
    public function firstOrCreate(array $where, array $attributes)
    {
        return $this->model->firstOrCreate($where, $attributes);
    }

    /**
     * Get First selected row
     *
     *
     * @return Model
     */
    public function firstWhere(array $where)
    {
        return $this->model->where($where)->first();
    }

    /**
     * Update Specified resource
     *
     * @param  Model  $model
     */
    public function update(array $data, int $id, ?Model $model = null): bool
    {
        $model = $model ?? $this->model->find($id);
        if ($model) {
            return $model->update($data);
        }

        return false;
    }

    /**
     * Method findWith
     *
     *
     * @return Model
     */
    public function findWith(int $id, array $with = [])
    {
        return $this->model->with($with)->where(['id' => $id])->first();
    }

    /**
     * Method deleteWhere
     *
     * @param $id $id [explicite description]
     * @return void
     */
    public function deleteWhere($id)
    {
        return $this->model->destroy($id);
    }
}
