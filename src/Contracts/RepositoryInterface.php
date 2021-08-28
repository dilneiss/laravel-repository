<?php


namespace JetBox\Repositories\Contracts;



interface RepositoryInterface
{
    /**
     * @param string[] $columns
     * @param false $take
     * @param false $pagination
     * @param false $where
     * @return mixed
     */
    public function get($columns = ['*'], $take = false, $pagination = false, $where = false);

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * @param $take
     * @param string[] $columns
     * @return mixed
     */
    public function take($take, $columns = ['*']);

    /**
     * @param false $perPage
     * @param string[] $columns
     * @return mixed
     */
    public function paginate($perPage = false, $columns = ['*']);

    /**
     * @param $relations
     * @param string[] $columns
     * @param int $paginate
     * @return mixed
     */
    public function withPaginate($relations, $columns = ['*'], $paginate = 15);

    /**
     * @param false $perPage
     * @param string[] $columns
     * @return mixed
     */
    public function simplePaginate($perPage = false, $columns = ['*']);

    /**
     * @param $take
     * @param string[] $columns
     * @return mixed
     */
    public function limit($take, $columns = ['*']);

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $ids
     * @param string[] $columns
     * @return mixed
     */
    public function findMany($ids, $columns = ['*']);

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*']);

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function first($columns = ['*']);

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function firstOrFail($columns = ['*']);

    /**
     * @param $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function where($column, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereOrFail($column, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereAll($column, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param null $value
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function whereWithAll($column, $value = null, $relations, $columns = ['*']);

    /**
     * @param $column
     * @param array $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereBetween($column, $value = [], $columns = ['*']);

    /**
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function with($relations, $columns = ['*']);

    /**
     * @param $relations
     * @param string[] $columns
     * @return mixed
     */
    public function withCount($relations, $columns = ['*']);

    /**
     * @param $column
     * @param null $key
     * @return mixed
     */
    public function pluck($column, $key = null);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function forceCreate(array $attributes);

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id): bool;

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function updateTap(array $attributes, int $id);

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function updateForce(array $attributes, int $id): bool;

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function updateForceTap(array $attributes, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
