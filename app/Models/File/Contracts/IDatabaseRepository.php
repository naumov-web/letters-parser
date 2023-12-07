<?php

namespace App\Models\File\Contracts;

use App\Models\File\DTO\FileDTO;

/**
 * Interface IDatabaseRepository
 * @package App\Models\File\Contracts
 */
interface IDatabaseRepository
{
    /**
     * Create file in database
     *
     * @param FileDTO $dto
     * @return int
     */
    public function create(FileDTO $dto): int;
}
