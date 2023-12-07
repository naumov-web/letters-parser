<?php

namespace App\UseCases\CollectionItem\InputDTO;

use App\Models\Base\DTO\CreateFileDTO;
use App\UseCases\Base\DTO\BaseUseCaseDTO;

/**
 * Class CreateCollectionItemInputDTO
 * @package App\UseCases\CollectionItem\InputDTO
 */
final class CreateCollectionItemInputDTO extends BaseUseCaseDTO
{
    /**
     * Collection id value
     * @var int
     */
    public int $collectionId;

    /**
     * Collection item name value
     * @var string
     */
    public string $name;

    /**
     * Collection item file instance DTO
     * @var CreateFileDTO|null
     */
    public ?CreateFileDTO $file = null;
}
