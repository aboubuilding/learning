<?php

namespace App\Repositories\Interfaces;

use App\Models\ReponseTentative;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ReponseTentativeRepositoryInterface
{
    /**
     * Récupère tous les enregistrements.
     *
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Récupère un enregistrement par son ID.
     *
     * @param int $id
     * @return ReponseTentative|null
     */
    public function find(int $id): ?ReponseTentative;

    /**
     * Crée un nouvel enregistrement.
     *
     * @param array $data
     * @return ReponseTentative
     */
    public function create(array $data): ReponseTentative;

    /**
     * Met à jour un enregistrement.
     *
     * @param int $id
     * @param array $data
     * @return ReponseTentative|null
     */
    public function update(int $id, array $data): ?ReponseTentative;

    /**
     * Supprime un enregistrement (soft delete ou physique).
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Récupère les enregistrements avec pagination.
     *
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator;

    /**
     * Recherche des enregistrements selon des critères.
     *
     * @param array $criteria
     * @param array $columns
     * @return Collection
     */
    public function findBy(array $criteria, array $columns = ['*']): Collection;

    /**
     * Trouve un enregistrement selon des critères (unique).
     *
     * @param array $criteria
     * @param array $columns
     * @return ReponseTentative|null
     */
    public function findOneBy(array $criteria, array $columns = ['*']): ?ReponseTentative;
}