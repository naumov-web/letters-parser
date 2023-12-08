<?php

namespace App\UseCases\CollectionItem\InputDTO;

use App\UseCases\Base\DTO\BaseUseCaseListDTO;

/**
 * Class GetCollectionItemsInputDTO
 * @package App\UseCases\CollectionItem\InputDTO
 */
final class GetCollectionItemsInputDTO extends BaseUseCaseListDTO
{
    /**
     * Collection id value
     * @var int
     */
    public int $collectionId;
}
