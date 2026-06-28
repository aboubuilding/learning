<?php

namespace App\Repositories\Eloquent;

use App\Models\UtilisateurRole;
use App\Repositories\Interfaces\UtilisateurRoleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UtilisateurRoleRepository implements UtilisateurRoleRepositoryInterface
{
    protected $utilisateurRole;

    public function __construct(App\Models\UtilisateurRole $utilisateurRole)
    {
        $this->utilisateurRole = $utilisateurRole;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->utilisateurRole->get($columns);
    }

    public function find(int $id): ?UtilisateurRole
    {
        return $this->utilisateurRole->find($id);
    }

    public function create(array $data): UtilisateurRole
    {
        return $this->utilisateurRole->create($data);
    }

    public function update(int $id, array $data): ?UtilisateurRole
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
        return $this->utilisateurRole->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->utilisateurRole->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?UtilisateurRole
    {
        $query = $this->utilisateurRole->newQuery();

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