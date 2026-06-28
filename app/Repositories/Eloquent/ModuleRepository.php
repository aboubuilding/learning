<?php

namespace App\Repositories\Eloquent;

use App\Models\Module;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ModuleRepository implements ModuleRepositoryInterface
{
    protected $module;

    public function __construct(App\Models\Module $module)
    {
        $this->module = $module;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->module->get($columns);
    }

    public function find(int $id): ?Module
    {
        return $this->module->find($id);
    }

    public function create(array $data): Module
    {
        return $this->module->create($data);
    }

    public function update(int $id, array $data): ?Module
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
        return $this->module->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->module->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?Module
    {
        $query = $this->module->newQuery();

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