<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(App\Models\User $user)
    {
        $this->user = $user;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->user->get($columns);
    }

    public function find(int $id): ?User
    {
        return $this->user->find($id);
    }

    public function create(array $data): User
    {
        return $this->user->create($data);
    }

    public function update(int $id, array $data): ?User
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
        return $this->user->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->user->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?User
    {
        $query = $this->user->newQuery();

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