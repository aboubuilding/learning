<?php

namespace App\Repositories\Eloquent;

use App\Models\EvaluationRessource;
use App\Repositories\Interfaces\EvaluationRessourceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EvaluationRessourceRepository implements EvaluationRessourceRepositoryInterface
{
    protected $evaluationRessource;

    public function __construct(App\Models\EvaluationRessource $evaluationRessource)
    {
        $this->evaluationRessource = $evaluationRessource;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->evaluationRessource->get($columns);
    }

    public function find(int $id): ?EvaluationRessource
    {
        return $this->evaluationRessource->find($id);
    }

    public function create(array $data): EvaluationRessource
    {
        return $this->evaluationRessource->create($data);
    }

    public function update(int $id, array $data): ?EvaluationRessource
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
        return $this->evaluationRessource->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->evaluationRessource->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?EvaluationRessource
    {
        $query = $this->evaluationRessource->newQuery();

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