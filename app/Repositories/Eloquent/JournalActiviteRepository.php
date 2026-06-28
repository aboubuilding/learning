<?php

namespace App\Repositories\Eloquent;

use App\Models\JournalActivite;
use App\Repositories\Interfaces\JournalActiviteRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JournalActiviteRepository implements JournalActiviteRepositoryInterface
{
    protected $journalActivite;

    public function __construct(App\Models\JournalActivite $journalActivite)
    {
        $this->journalActivite = $journalActivite;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->journalActivite->get($columns);
    }

    public function find(int $id): ?JournalActivite
    {
        return $this->journalActivite->find($id);
    }

    public function create(array $data): JournalActivite
    {
        return $this->journalActivite->create($data);
    }

    public function update(int $id, array $data): ?JournalActivite
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
        return $this->journalActivite->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->journalActivite->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?JournalActivite
    {
        $query = $this->journalActivite->newQuery();

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