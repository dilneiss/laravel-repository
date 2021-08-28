<?php


namespace JetBox\Repositories\Eloquent;


use JetBox\Repositories\Contracts\RepositoryInterface;
use JetBox\Repositories\Traits\BaseRepositoryTrait as BaseRepository;


abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * Trait
     */
    use BaseRepository {
        baseOrderBy as orderBy;
    }

    /**
     * @var bool
     */
    public $model = false;

    /**
     * AbstractRepository constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @return mixed
     */
    abstract protected function model();

    /**
     * @return $this
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * //$this->model = new $this->model; || return new $this->model
     */
    private function makeModel()
    {
        $model = app()->make($this->model());

        $this->model = $model;

        return $this;
    }

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
    )
    {
        $builder = $this->orderBy($orderByColumn, $orderByDirection);

        if ($take) {
            $builder->take($take);
        }

        if ($pagination) {
            return $builder->paginate($pagination);
        }

        if ($where) {
            $builder->where($where[0], $where[1]);
        }

        return $builder->get($columns);
    }

    /**
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function all($columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc')
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->get($columns);
    }

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function take($take, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc')
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->take($take)
            ->get($columns);
    }

    /**
     * @param false $perPage
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function paginate(
        $perPage = false, $columns = ['*'],
        $orderByColumn = 'created_at', $orderByDirection = 'desc')
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->paginate($perPage, $columns);
    }

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
    )
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->with($relations)
            ->paginate($paginate);
    }

    /**
     * @param false $perPage
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function simplePaginate(
        $perPage = false, $columns = ['*'],
        $orderByColumn = 'created_at', $orderByDirection = 'desc'
    )
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->simplePaginate($perPage, $columns);
    }

    /**
     * @param $take
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function limit($take, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc')
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->limit($take)
            ->get($columns);
    }

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $ids
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function findMany($ids, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc')
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->findMany($ids, $columns);
    }

    /**
     * @param $id
     * @param string[] $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    /**
     * @param string[] $columns
     * @return mixed
     */
    public function firstOrFail($columns = ['*'])
    {
        return $this->model->firstOrFail($columns);
    }

    /**
     * @param  \Closure|string|array|\Illuminate\Database\Query\Expression  $column
     * @param null $operator
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function where($column, $operator = null, $value = null, $columns = ['*'])
    {
        return $this->model->where($column, $operator, $value)->first($columns);
    }

    /**
     * @param  \Closure|string|array|\Illuminate\Database\Query\Expression  $column
     * @param null $operator
     * @param null $value
     * @param string[] $columns
     * @return mixed
     */
    public function whereOrFail($column, $operator = null, $value = null, $columns = ['*'])
    {
        return $this->model->where($column, $operator, $value)->firstOrFail($columns);
    }

    /**
     * @param \Closure|string|array|\Illuminate\Database\Query\Expression $column
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
    )
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->where($column, $operator, $value)
            ->get($columns);
    }

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
    )
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->where($column, $operator, $value)
            ->with($relations)
            ->get($columns);
    }

    /**
     * @param string|\Illuminate\Database\Query\Expression $column
     * @param array $value
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function whereBetween(
        $column, $value = [], $columns = ['*'],
        $orderByColumn = 'created_at', $orderByDirection = 'desc'
    )
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->whereBetween($column, $value)
            ->get($columns);
    }

    /**
     * @param $relations
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function with($relations, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc')
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->with($relations)
            ->get($columns);
    }

    /**
     * @param $relations
     * @param string[] $columns
     * @param string $orderByColumn
     * @param string $orderByDirection
     * @return mixed
     */
    public function withCount($relations, $columns = ['*'], $orderByColumn = 'created_at', $orderByDirection = 'desc')
    {
        return $this
            ->orderBy($orderByColumn, $orderByDirection)
            ->withCount($relations)
            ->get($columns);
    }

    /**
     * @param $column
     * @param null $key
     * @return mixed|void
     */
    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function forceCreate(array $attributes)
    {
        return $this->model->forceCreate($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->baseUpdate($attributes, $id)->update();
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function updateTap(array $attributes, int $id)
    {
        return tap($this->baseUpdate($attributes, $id))->update();
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function updateForce(array $attributes, int $id): bool
    {
        return $this->baseUpdateForce($attributes, $id)->update();
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function updateForceTap(array $attributes, int $id)
    {
        return tap($this->baseUpdateForce($attributes, $id))->update();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }
}
