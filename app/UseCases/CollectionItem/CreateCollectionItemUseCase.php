<?php

namespace App\UseCases\CollectionItem;

use App\Models\Base\DTO\CreateFileDTO;
use App\Models\Base\DTO\MorphDTO;
use App\Models\CollectionItem\Contracts\IDatabaseRepository;
use App\Models\CollectionItem\DTO\CollectionItemDTO;
use App\Models\CollectionItem\Exceptions\CollectionItemWithNameAlreadyExistsException;
use App\Models\CollectionItem\Model;
use App\Models\File\Contracts\IFileService;
use App\Models\File\Enums\SemanticTypesEnum;
use App\UseCases\BaseUseCase;
use App\UseCases\CollectionItem\InputDTO\CreateCollectionItemInputDTO;

/**
 * Class CreateCollectionItemUseCase
 * @package App\UseCases\CollectionItem
 */
final class CreateCollectionItemUseCase extends BaseUseCase
{
    /**
     * CreateCollectionItemUseCase constructor
     * @param IDatabaseRepository $databaseRepository
     * @param IFileService $service
     */
    public function __construct(
        private IDatabaseRepository $databaseRepository,
        private IFileService $service
    ) {}

    /**
     * @inheritDoc
     */
    protected function getInputDTOClass(): ?string
    {
        return CreateCollectionItemInputDTO::class;
    }

    /**
     * @inheritDoc
     * @throws CollectionItemWithNameAlreadyExistsException
     */
    public function execute(): void
    {
        /** @var CreateCollectionItemInputDTO $inputDto */
        $inputDto = $this->inputDto;

        $this->checkIsItemExists($inputDto->collectionId, $inputDto->name);

        $modelDto = new CollectionItemDTO();
        $modelDto->name = $inputDto->name;
        $modelDto->collectionId = $inputDto->collectionId;

        $modelDto = $this->databaseRepository->create($modelDto);

        if ($inputDto->file) {
            $this->createFile(
                $modelDto,
                $inputDto->file
            );
        }
    }

    /**
     * Create file for model
     *
     * @param CollectionItemDTO $modelDto
     * @param CreateFileDTO $fileDto
     * @return void
     */
    private function createFile(CollectionItemDTO $modelDto, CreateFileDTO $fileDto): void
    {
        $morphDto = new MorphDTO();
        $morphDto->ownerId = $modelDto->id;
        $morphDto->ownerType = Model::class;

        $this->service->create(
            $morphDto,
            $fileDto,
            SemanticTypesEnum::ORIGIN_EXAMPLE
        );
    }

    /**
     * Check is item exists
     *
     * @param int $collectionId
     * @param string $name
     * @return void
     * @throws CollectionItemWithNameAlreadyExistsException
     */
    private function checkIsItemExists(int $collectionId, string $name): void
    {
        if ($this->databaseRepository->isItemExists($collectionId, $name)) {
            throw new CollectionItemWithNameAlreadyExistsException();
        }
    }
}
