<?php

namespace App\Repositories\Eloquent;

use App\Models\Ressource;
use App\Repositories\Interfaces\RessourceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RessourceRepository implements RessourceRepositoryInterface
{
    protected $ressource;

    public function __construct(App\Models\Ressource $ressource)
    {
        $this->ressource = $ressource;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->ressource->get($columns);
    }

    public function find(int $id): ?Ressource
    {
        return $this->ressource->find($id);
    }

    public function create(array $data): Ressource
    {
        return $this->ressource->create($data);
    }

    public function update(int $id, array $data): ?Ressource
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
        return $this->ressource->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->ressource->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?Ressource
    {
        $query = $this->ressource->newQuery();

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