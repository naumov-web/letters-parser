<?php

namespace App\UseCases\Collection;

use App\Models\Base\DTO\IndexDTO;
use App\Models\Base\DTO\ListDTO;
use App\Models\Collection\Contracts\IDatabaseRepository;
use App\UseCases\BaseUseCase;
use App\UseCases\Collection\InputDTO\GetCollectionsInputDTO;

/**
 * Class GetCollectionsUseCase
 * @package App\UseCases\Collection
 */
final class GetCollectionsUseCase extends BaseUseCase
{
    /**
     * List DTO instance
     * @var ListDTO
     */
    private ListDTO $listDto;

    /**
     * GetCollectionsUseCase constructor
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
        return GetCollectionsInputDTO::class;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        /** @var GetCollectionsInputDTO $inputDto */
        $inputDto = $this->inputDto;
        $indexDto = $inputDto->getIndexDTO();

        $this->listDto = $this->databaseRepository->index($indexDto);
    }
}
