<?php

namespace App\Repositories\Eloquent;

use App\Models\Progression;
use App\Repositories\Interfaces\ProgressionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProgressionRepository implements ProgressionRepositoryInterface
{
    protected $progression;

    public function __construct(App\Models\Progression $progression)
    {
        $this->progression = $progression;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->progression->get($columns);
    }

    public function find(int $id): ?Progression
    {
        return $this->progression->find($id);
    }

    public function create(array $data): Progression
    {
        return $this->progression->create($data);
    }

    public function update(int $id, array $data): ?Progression
    {
        $model = $this->find($id);
        if (!$model) {
            return null;
        }
        $model->update($data);
        return $model->fresh();
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if (!$model) {
            return false;
        }
        return $model->delete();
    }

    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->progression->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->progression->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?Progression
    {
        $query = $this->progression->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first($columns);
    }
}