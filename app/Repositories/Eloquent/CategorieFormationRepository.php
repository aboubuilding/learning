<?php

namespace App\Repositories\Eloquent;

use App\Models\CategorieFormation;
use App\Repositories\Interfaces\CategorieFormationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategorieFormationRepository implements CategorieFormationRepositoryInterface
{
    protected $categorieFormation;

    public function __construct(App\Models\CategorieFormation $categorieFormation)
    {
        $this->categorieFormation = $categorieFormation;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->categorieFormation->get($columns);
    }

    public function find(int $id): ?CategorieFormation
    {
        return $this->categorieFormation->find($id);
    }

    public function create(array $data): CategorieFormation
    {
        return $this->categorieFormation->create($data);
    }

    public function update(int $id, array $data): ?CategorieFormation
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
        return $this->categorieFormation->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->categorieFormation->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?CategorieFormation
    {
        $query = $this->categorieFormation->newQuery();

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