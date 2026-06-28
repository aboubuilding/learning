<?php

namespace App\Repositories\Eloquent;

use App\Models\Certificat;
use App\Repositories\Interfaces\CertificatRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CertificatRepository implements CertificatRepositoryInterface
{
    protected $certificat;

    public function __construct(App\Models\Certificat $certificat)
    {
        $this->certificat = $certificat;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->certificat->get($columns);
    }

    public function find(int $id): ?Certificat
    {
        return $this->certificat->find($id);
    }

    public function create(array $data): Certificat
    {
        return $this->certificat->create($data);
    }

    public function update(int $id, array $data): ?Certificat
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
        return $this->certificat->paginate($perPage, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        $query = $this->certificat->newQuery();

        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get($columns);
    }

    public function findOneBy(array $criteria, array $columns = ['*']): ?Certificat
    {
        $query = $this->certificat->newQuery();

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