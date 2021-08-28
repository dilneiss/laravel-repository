<?php

namespace JetBox\Repositories\Traits;


use Exception;


trait BaseRepositoryTrait
{
    /**
     * Global OrderBy
     * @var null
     */
    protected $orderByDirection = null;

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    private function baseUpdate(array $attributes, int $id)
    {
        return $this->find($id)->fill($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    private function baseUpdateForce(array $attributes, int $id)
    {
        return $this->find($id)->forceFill($attributes);
    }

    /**
     * @param $column
     * @param $direction
     * @return mixed
     * @throws \Throwable
     */
    public function baseOrderBy($column, $direction)
    {
        if ($this->orderByDirection === 'desc') {
            return $this->model->latest($column);
        }

        if ($this->orderByDirection === 'asc') {
            return $this->model->oldest($column);
        }

        throw_if(
            !is_null($this->orderByDirection),
            new Exception(
                "$this->orderByDirection The Given Value Is Incorrect - The Value Should Be `desc` or `asc` or `null`"
            )
        );

        return $this->model->orderBy($column, $direction);
    }
}
