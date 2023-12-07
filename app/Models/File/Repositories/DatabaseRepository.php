<?php

namespace App\Models\File\Repositories;

use App\Models\Base\Repositories\BaseDatabaseRepository;
use App\Models\File\Contracts\IDatabaseRepository;
use App\Models\File\DTO\FileDTO;
use App\Models\File\Model;

/**
 * Class DatabaseRepository
 * @package App\Models\File\Repositories
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
    public function create(FileDTO $dto): int
    {
        $data = $dto->toArray();
        /** @var Model $model */
        $model = $this->getQuery()->create($data);

        return $model->id;
    }
}
