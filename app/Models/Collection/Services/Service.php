<?php

namespace App\Models\Collection\Services;

use App\Models\Collection\Contracts\ICollectionService;
use App\Models\Collection\Contracts\IDatabaseRepository;
use App\Models\Collection\Exceptions\CollectionWithNameAlreadyExistsException;

/**
 * Class Service
 * @package App\Models\Collection\Services
 */
final class Service implements ICollectionService
{
    /**
     * Service constructor
     * @param IDatabaseRepository $repository
     */
    public function __construct(private IDatabaseRepository $repository) {}

    /**
     * @inheritDoc
     * @throws CollectionWithNameAlreadyExistsException
     */
    public function create(string $name)
    {
        $existingModel = $this->repository->getByName($name);

        if ($existingModel) {
            throw new CollectionWithNameAlreadyExistsException();
        }

        $this->repository->create($name);
    }
}
