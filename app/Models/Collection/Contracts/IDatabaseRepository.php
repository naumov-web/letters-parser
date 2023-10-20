<?php

namespace App\Models\Collection\Contracts;

use App\Models\Collection\DTO\CollectionDTO;

/**
 * Interface IDatabaseRepository
 * @package App\Models\Collection\Contracts
 */
interface IDatabaseRepository
{
    /**
     * Get collection DTO from database by name
     *
     * @param string $name
     * @return CollectionDTO|null
     */
    public function getByName(string $name): ?CollectionDTO;

    /**
     * Create collection instance
     *
     * @param string $name
     * @return CollectionDTO
     */
    public function create(string $name): CollectionDTO;
}
