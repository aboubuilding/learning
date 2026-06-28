<?php

namespace App\Repositories\Eloquent;

use App\Models\SuiviRessource;
use App\Repositories\Interfaces\SuiviRessourceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SuiviRessourceRepository implements SuiviRessourceRepositoryInterface
{
    protected $suiviRessource;

    public function __construct(App\Models\SuiviRessource $suiviRessource)
    {
        $this->suiviRessource = $suiviRessource;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->suiviRessource->get($columns);
    }

    public function find(int $id): ?SuiviRessource
    {
        return $this->suiviRessource->find($id);
    }

    public function create(array $data): SuiviRessource
    {
        return $this->suiviRessource->create($data);
    }

    public function update(int $id, array $data): ?SuiviRessource
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
        return $this->suiviRessource->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->suiviRessource->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?SuiviRessource
    {
        $query = $this->suiviRessource->newQuery();

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