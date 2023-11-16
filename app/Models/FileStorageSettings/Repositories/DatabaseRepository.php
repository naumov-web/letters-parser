<?php

namespace App\Models\FileStorageSettings\Repositories;

use App\Models\Base\Repositories\BaseDatabaseRepository;
use App\Models\FileStorageSettings\Contracts\IDatabaseRepository;
use App\Models\FileStorageSettings\DTO\FileStorageSettingsDTO;
use App\Models\FileStorageSettings\Model;

/**
 * Class DatabaseRepository
 * @package App\Models\FileStorageConfiguration\Repositories
 */
final class DatabaseRepository extends BaseDatabaseRepository implements IDatabaseRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelsClass(): string
    {
        return Model::class;
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(FileStorageSettingsDTO $dto): void
    {
        $model = $this->getQuery()
            ->where('system_name', $dto->systemName)
            ->first();
        $modelData = $dto->toArray();

        if (!$model) {
            $this->getQuery()->create($modelData);
        } else {
            $model->update($modelData);
        }
    }
}
