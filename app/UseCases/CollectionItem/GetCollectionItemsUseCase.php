<?php

namespace App\UseCases\CollectionItem;

use App\Models\Base\DTO\ListDTO;
use App\Models\CollectionItem\Contracts\IDatabaseRepository;
use App\UseCases\BaseUseCase;
use App\UseCases\CollectionItem\InputDTO\GetCollectionItemsInputDTO;

/**
 * Class GetCollectionItemsUseCase
 * @package App\UseCases\CollectionItem
 */
final class GetCollectionItemsUseCase extends BaseUseCase
{
    /**
     * List DTO instance
     * @var ListDTO
     */
    private ListDTO $listDto;

    /**
     * GetCollectionItemsUseCase constructor
     * @param IDatabaseRepository $databaseRepository
     */
    public function __construct(private IDatabaseRepository $databaseRepository) {}

    /**
     * Get list DTO instance
     *
     * @return ListDTO
     */
    public function getListDto(): ListDTO
    {
        return $this->listDto;
    }

    /**
     * @inheritDoc
     */
    protected function getInputDTOClass(): ?string
    {
        return GetCollectionItemsInputDTO::class;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        /** @var GetCollectionItemsInputDTO $inputDto */
        $inputDto = $this->inputDto;
        $indexDto = $inputDto->getIndexDTO();

        $this->listDto = $this->databaseRepository->index($inputDto->collectionId, $indexDto);
    }
}
