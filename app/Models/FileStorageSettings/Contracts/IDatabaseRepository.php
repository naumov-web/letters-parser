<?php

namespace App\Models\FileStorageSettings\Contracts;

use App\Models\FileStorageSettings\DTO\FileStorageSettingsDTO;

/**
 * Interface IDatabaseRepository
 * @package App\Models\FileStorageConfiguration\Contracts
 */
interface IDatabaseRepository
{
    /**
     * Update file storage configuration or create if doesn't exist
     *
     * @param FileStorageSettingsDTO $dto
     * @return void
     */
    public function updateOrCreate(FileStorageSettingsDTO $dto): void;
}
