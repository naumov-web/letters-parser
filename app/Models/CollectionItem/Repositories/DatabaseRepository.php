<?php

namespace App\Models\CollectionItem\Repositories;

use App\Models\Base\DTO\IndexDTO;
use App\Models\Base\DTO\ListDTO;
use App\Models\Base\Repositories\BaseDatabaseRepository;
use App\Models\CollectionItem\Composers\CollectionItemDTOComposer;
use App\Models\CollectionItem\Contracts\IDatabaseRepository;
use App\Models\CollectionItem\DTO\CollectionItemDTO;
use App\Models\CollectionItem\Model;
use Illuminate\Support\Arr;

/**
 * Class DatabaseRepository
 * @package App\Models\CollectionItem\Repositories
 */
final class DatabaseRepository extends BaseDatabaseRepository implements IDatabaseRepository
{
    /**
     * DatabaseRepository constructor
     * @param CollectionItemDTOComposer $composer
     */
    public function __construct(private CollectionItemDTOComposer $composer) {}

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
    public function create(CollectionItemDTO $dto): CollectionItemDTO
    {
        $resultDto = $dto;
        $data = Arr::only(
            $resultDto->toArray(),
            [
                'name',
                'collection_id'
            ]
        );

        $model = $this->getQuery()->create($data);
        $resultDto->id = $model->id;

        return $resultDto;
    }

    /**
     * @inheritDoc
     */
    public function isItemExists(int $collectionId, string $name): bool
    {
        $query = $this->getQuery();
        $query->where('collection_id', $collectionId);
        $query->where('name', $name);

        return $query->exists();
    }

    /**
     * @inheritDoc
     */
    public function index(int $collectionId, IndexDTO $dto): ListDTO
    {
        $query = $this->getQuery();
        $query->where('collection_id', $collectionId);
        $query = $this->applyPaginationAndSorting(
            $query,
            $dto
        );
        $count = $query->count();

        return new ListDTO(
            $this->composer->getFromCollection($query->get()),
            $count
        );
    }
}
