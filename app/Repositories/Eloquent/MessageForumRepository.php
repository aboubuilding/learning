<?php

namespace App\Repositories\Eloquent;

use App\Models\MessageForum;
use App\Repositories\Interfaces\MessageForumRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MessageForumRepository implements MessageForumRepositoryInterface
{
    protected $messageForum;

    public function __construct(App\Models\MessageForum $messageForum)
    {
        $this->messageForum = $messageForum;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->messageForum->get($columns);
    }

    public function find(int $id): ?MessageForum
    {
        return $this->messageForum->find($id);
    }

    public function create(array $data): MessageForum
    {
        return $this->messageForum->create($data);
    }

    public function update(int $id, array $data): ?MessageForum
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
        return $this->messageForum->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->messageForum->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?MessageForum
    {
        $query = $this->messageForum->newQuery();

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