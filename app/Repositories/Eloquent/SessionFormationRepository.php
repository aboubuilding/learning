<?php

namespace App\Repositories\Eloquent;

use App\Models\SessionFormation;
use App\Repositories\Interfaces\SessionFormationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SessionFormationRepository implements SessionFormationRepositoryInterface
{
    protected $sessionFormation;

    public function __construct(App\Models\SessionFormation $sessionFormation)
    {
        $this->sessionFormation = $sessionFormation;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->sessionFormation->get($columns);
    }

    public function find(int $id): ?SessionFormation
    {
        return $this->sessionFormation->find($id);
    }

    public function create(array $data): SessionFormation
    {
        return $this->sessionFormation->create($data);
    }

    public function update(int $id, array $data): ?SessionFormation
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
        return $this->sessionFormation->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->sessionFormation->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?SessionFormation
    {
        $query = $this->sessionFormation->newQuery();

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