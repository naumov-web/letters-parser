<?php

namespace App\Models\Base\Repositories;

use App\Models\Base\DTO\IndexDTO;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BaseDatabaseRepository
 * @package App\Models\Base\Repositories
 */
abstract class BaseDatabaseRepository
{
    /**
     * Get model class name
     *
     * @return string
     */
    abstract protected function getModelsClass(): string;

    /**
     * Get query builder instance
     *
     * @return Builder
     */
    protected function getQuery(): Builder
    {
        $className = $this->getModelsClass();
        /** @var Builder $query */
        $query = $className::query();

        return $query;
    }

    /**
     * Apply pagination and sorting at query
     *
     * @param Builder $query
     * @param IndexDTO $indexDto
     * @return Builder
     */
    protected function applyPaginationAndSorting(Builder $query, IndexDTO $indexDto): Builder
    {
        if (!is_null($indexDto->limit)) {
            $query->limit($indexDto->limit);
        }

        if (!is_null($indexDto->offset)) {
            $query->limit($indexDto->offset);
        }

        if (!is_null($indexDto->sortBy) && !is_null($indexDto->sortDirection)) {
            $query->orderBy(
                $indexDto->sortBy,
                $indexDto->sortDirection
            );
        }

        return $query;
    }
}
