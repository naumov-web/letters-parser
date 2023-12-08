<?php

namespace App\UseCases\CollectionItem\InputDTO;

use App\Models\Base\DTO\CreateFileDTO;
use App\UseCases\Base\DTO\BaseUseCaseDTO;

/**
 * Class CreateCollectionItemExampleInputDTO
 * @package App\UseCases\CollectionItem\InputDTO
 */
final class CreateCollectionItemExampleInputDTO extends BaseUseCaseDTO
{
    /**
     * Collection item id value
     * @var int
     */
    public int $collectionItemId;

    /**
     * Collection item file instance DTO
     * @var CreateFileDTO
     */
    public CreateFileDTO $file;
}
