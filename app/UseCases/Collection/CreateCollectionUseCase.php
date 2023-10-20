<?php

namespace App\UseCases\Collection;

use App\Models\Collection\Contracts\ICollectionService;
use App\UseCases\BaseUseCase;
use App\UseCases\Collection\InputDTO\CreateCollectionInputDTO;

/**
 * Class CreateCollectionUseCase
 * @package App\UseCases\Collection
 */
final class CreateCollectionUseCase extends BaseUseCase
{
    /**
     * CreateCollectionUseCase constructor
     * @param ICollectionService $service
     */
    public function __construct(private ICollectionService $service) {}

    /**
     * @inheritDoc
     */
    protected function getInputDTOClass(): ?string
    {
        return CreateCollectionInputDTO::class;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        /** @var CreateCollectionInputDTO $inputDto */
        $inputDto = $this->inputDto;
        $this->service->create($inputDto->name);
    }
}
