<?php

namespace App\Models\FileStorageConfiguration\Repositories;

use App\Models\Base\Repositories\BaseDatabaseRepository;
use App\Models\FileStorageConfiguration\Contracts\IDatabaseRepository;
use App\Models\FileStorageConfiguration\DTO\FileStorageConfigurationDTO;
use App\Models\FileStorageConfiguration\Model;

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
    public function updateOrCreate(FileStorageConfigurationDTO $dto): void
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
