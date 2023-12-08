<?php

namespace App\Models\CollectionItem\Contracts;

use App\Models\Base\DTO\IndexDTO;
use App\Models\Base\DTO\ListDTO;
use App\Models\CollectionItem\DTO\CollectionItemDTO;

/**
 * Interface IDatabaseRepository
 * @package App\Models\CollectionItem\Contracts
 */
interface IDatabaseRepository
{
    /**
     * Create collection item
     *
     * @param CollectionItemDTO $dto
     * @return CollectionItemDTO
     */
    public function create(CollectionItemDTO $dto): CollectionItemDTO;

    /**
     * Check is item exists
     *
     * @param int $collectionId
     * @param string $name
     * @return bool
     */
    public function isItemExists(int $collectionId, string $name): bool;

    /**
     * Get collection items
     *
     * @param int $collectionId
     * @param IndexDTO $dto
     * @return ListDTO
     */
    public function index(int $collectionId, IndexDTO $dto): ListDTO;
}
