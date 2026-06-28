<?php

namespace App\Repositories\Eloquent;

use App\Models\QuestionQuizz;
use App\Repositories\Interfaces\QuestionQuizzRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class QuestionQuizzRepository implements QuestionQuizzRepositoryInterface
{
    protected $questionQuizz;

    public function __construct(App\Models\QuestionQuizz $questionQuizz)
    {
        $this->questionQuizz = $questionQuizz;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->questionQuizz->get($columns);
    }

    public function find(int $id): ?QuestionQuizz
    {
        return $this->questionQuizz->find($id);
    }

    public function create(array $data): QuestionQuizz
    {
        return $this->questionQuizz->create($data);
    }

    public function update(int $id, array $data): ?QuestionQuizz
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
        return $this->questionQuizz->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->questionQuizz->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?QuestionQuizz
    {
        $query = $this->questionQuizz->newQuery();

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