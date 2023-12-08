<?php

namespace App\UseCases\CollectionItem;

use App\Models\Base\DTO\MorphDTO;
use App\Models\CollectionItem\Model;
use App\Models\File\Contracts\IFileService;
use App\Models\File\Enums\SemanticTypesEnum;
use App\UseCases\BaseUseCase;
use App\UseCases\CollectionItem\InputDTO\CreateCollectionItemExampleInputDTO;

/**
 * Class CreateCollectionItemExampleUseCase
 * @package App\UseCases\CollectionItem
 */
final class CreateCollectionItemExampleUseCase extends BaseUseCase
{
    /**
     * CreateCollectionItemExampleUseCase constructor
     * @param IFileService $service
     */
    public function __construct(private IFileService $service) {}

    /**
     * @inheritDoc
     */
    protected function getInputDTOClass(): ?string
    {
        return CreateCollectionItemExampleInputDTO::class;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        /** @var CreateCollectionItemExampleInputDTO $inputDto */
        $inputDto = $this->inputDto;
        $morphDto = new MorphDTO();
        $morphDto->ownerId = $inputDto->collectionItemId;
        $morphDto->ownerType = Model::class;

        $this->service->create(
            $morphDto,
            $inputDto->file,
            SemanticTypesEnum::TEACHING_EXAMPLE
        );
    }
}
