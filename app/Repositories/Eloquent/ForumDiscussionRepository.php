<?php

namespace App\Repositories\Eloquent;

use App\Models\ForumDiscussion;
use App\Repositories\Interfaces\ForumDiscussionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ForumDiscussionRepository implements ForumDiscussionRepositoryInterface
{
    protected $forumDiscussion;

    public function __construct(App\Models\ForumDiscussion $forumDiscussion)
    {
        $this->forumDiscussion = $forumDiscussion;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->forumDiscussion->get($columns);
    }

    public function find(int $id): ?ForumDiscussion
    {
        return $this->forumDiscussion->find($id);
    }

    public function create(array $data): ForumDiscussion
    {
        return $this->forumDiscussion->create($data);
    }

    public function update(int $id, array $data): ?ForumDiscussion
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
        return $this->forumDiscussion->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->forumDiscussion->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?ForumDiscussion
    {
        $query = $this->forumDiscussion->newQuery();

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