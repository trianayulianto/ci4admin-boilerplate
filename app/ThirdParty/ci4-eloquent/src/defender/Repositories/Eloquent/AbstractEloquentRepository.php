<?php

namespace Artesaos\Defender\Repositories\Eloquent;

use Artesaos\Defender\Contracts\Repositories\AbstractRepository;

/**
 * Class AbstractEloquentRepository.
 */
abstract class AbstractEloquentRepository implements AbstractRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public function __construct($model)
    {
        $this->model = new $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Returns all from the current model.
     *
     * @return static
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Return paginated results.
     *
     * @param  int  $perPage  Number of results per page
     * @return static
     */
    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Return a new instance of the current model.
     *
     *
     * @return static
     */
    public function newInstance(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * @param  int  $id
     * @return Model|null
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByName($name)
    {
        return $this->model->where('name', '=', $name)->first();
    }

    /**
     * @param  string|int  $value
     * @param  string  $key
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList($value, $key = 'id')
    {
        return $this->model->pluck($value, $key);
    }

    /**
     * Set Relationships.
     *
     * @param  array  $with  Relationships
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function make(array $with = [])
    {
        return $this->model->with($with);
    }
}
