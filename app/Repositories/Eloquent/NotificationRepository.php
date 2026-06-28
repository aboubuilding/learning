<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NotificationRepository implements NotificationRepositoryInterface
{
    protected $notification;

    public function __construct(App\Models\Notification $notification)
    {
        $this->notification = $notification;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->notification->get($columns);
    }

    public function find(int $id): ?Notification
    {
        return $this->notification->find($id);
    }

    public function create(array $data): Notification
    {
        return $this->notification->create($data);
    }

    public function update(int $id, array $data): ?Notification
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
        return $this->notification->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->notification->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?Notification
    {
        $query = $this->notification->newQuery();

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