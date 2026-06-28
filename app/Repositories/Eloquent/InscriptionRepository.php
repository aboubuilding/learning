<?php

namespace App\Repositories\Eloquent;

use App\Models\Inscription;
use App\Repositories\Interfaces\InscriptionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class InscriptionRepository implements InscriptionRepositoryInterface
{
    protected $inscription;

    public function __construct(App\Models\Inscription $inscription)
    {
        $this->inscription = $inscription;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->inscription->get($columns);
    }

    public function find(int $id): ?Inscription
    {
        return $this->inscription->find($id);
    }

    public function create(array $data): Inscription
    {
        return $this->inscription->create($data);
    }

    public function update(int $id, array $data): ?Inscription
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
        return $this->inscription->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->inscription->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?Inscription
    {
        $query = $this->inscription->newQuery();

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