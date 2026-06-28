<?php

namespace App\Repositories\Eloquent;

use App\Models\ParticipantSession;
use App\Repositories\Interfaces\ParticipantSessionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ParticipantSessionRepository implements ParticipantSessionRepositoryInterface
{
    protected $participantSession;

    public function __construct(App\Models\ParticipantSession $participantSession)
    {
        $this->participantSession = $participantSession;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->participantSession->get($columns);
    }

    public function find(int $id): ?ParticipantSession
    {
        return $this->participantSession->find($id);
    }

    public function create(array $data): ParticipantSession
    {
        return $this->participantSession->create($data);
    }

    public function update(int $id, array $data): ?ParticipantSession
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
        return $this->participantSession->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->participantSession->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?ParticipantSession
    {
        $query = $this->participantSession->newQuery();

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