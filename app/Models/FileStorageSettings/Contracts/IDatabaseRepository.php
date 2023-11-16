<?php

namespace App\Models\FileStorageConfiguration\Contracts;

use App\Models\FileStorageConfiguration\DTO\FileStorageConfigurationDTO;

/**
 * Interface IDatabaseRepository
 * @package App\Models\FileStorageConfiguration\Contracts
 */
interface IDatabaseRepository
{
    /**
     * Update file storage configuration or create if doesn't exist
     *
     * @param FileStorageConfigurationDTO $dto
     * @return void
     */
    public function updateOrCreate(FileStorageConfigurationDTO $dto): void;
}
