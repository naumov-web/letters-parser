<?php

namespace App\Models\Collection\Repositories;

use App\Models\Base\Repositories\BaseDatabaseRepository;
use App\Models\Collection\Composers\CollectionDTOComposer;
use App\Models\Collection\Contracts\IDatabaseRepository;
use App\Models\Collection\DTO\CollectionDTO;
use App\Models\Collection\Model;

/**
 * Class DatabaseRepository
 * @package App\Models\Collection\Repositories
 */
final class DatabaseRepository extends BaseDatabaseRepository implements IDatabaseRepository
{
    /**
     * DatabaseRepository constructor
     * @param CollectionDTOComposer $composer
     */
    public function __construct(private CollectionDTOComposer $composer) {}

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
    public function create(string $name): CollectionDTO
    {
        /** @var Model $model */
        $model = $this->getQuery()->create([
            'name' => $name
        ]);

        $result = new CollectionDTO();
        $result->id = $model->id;
        $result->name = $name;

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getByName(string $name): ?CollectionDTO
    {
        /** @var Model|null $model */
        $model = $this->getQuery()->where('name', $name)->first();

        if (!$model) {
            return null;
        }

        return $this->composer->getFromModel($model);
    }
}
