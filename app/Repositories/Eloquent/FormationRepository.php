<?php

namespace App\Repositories\Eloquent;

use App\Models\Formation;
use App\Repositories\Interfaces\FormationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class FormationRepository implements FormationRepositoryInterface
{
    protected $formation;

    public function __construct(App\Models\Formation $formation)
    {
        $this->formation = $formation;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->formation->get($columns);
    }

    public function find(int $id): ?Formation
    {
        return $this->formation->find($id);
    }

    public function create(array $data): Formation
    {
        return $this->formation->create($data);
    }

    public function update(int $id, array $data): ?Formation
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
        return $this->formation->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->formation->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?Formation
    {
        $query = $this->formation->newQuery();

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