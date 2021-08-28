<?php


namespace JetBox\Repositories\Contracts;



interface RepositoryInterface
{
    /**
     * @param string[] $columns
     * @param false $take
     * @param false $pagination
     * @param false $where
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function get(
        $columns = ['*'], $take = false, $pagination = false,
        $where = false, $orderByColumn = 'created_at', $orderByDirection = 'desc'
    );

    /**
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function all($columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc');

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function take($take, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc');

    /**
     * @param false $perPage
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function paginate(
        $perPage = false, $columns = ['*'],
        $orderByColumn = 'created_at', $orderByDirection = 'desc'
    );

    /**
     * @param $relations
     * @param string[] $columns
     * @param int $paginate
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function withPaginate(
        $relations, $columns = ['*'], $paginate = 15,
        $orderByColumn = 'created_at', $orderByDirection = 'desc'
    );

    /**
     * @param false $perPage
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function simplePaginate(
        $perPage = false, $columns = ['*'],
        $orderByColumn = 'created_at', $orderByDirection = 'desc'
    );

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function limit($take, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc');

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $ids
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function findMany($ids, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc');

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
     * @param null $operator
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function where($column, $operator = null, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereOrFail($column, $operator = null, $value = null, $columns = ['*']);

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function whereAll(
        $column, $operator = null, $value = null,
        $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc'
    );

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param $relations
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function whereWithAll(
        $column, $operator = null, $value = null, $relations,
        $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc'
    );

    /**
     * @param $column
     * @param array $value
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function whereBetween(
        $column, $value = [], $columns = ['*'],
        $orderByColumn = 'created_at', $orderByDirection = 'desc'
    );

    /**
     * @param $relations
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function with($relations, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc');

    /**
     * @param $relations
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function withCount($relations, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc');

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
