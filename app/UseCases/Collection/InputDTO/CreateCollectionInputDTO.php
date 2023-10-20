<?php

namespace App\UseCases\Collection\InputDTO;

use App\UseCases\Base\DTO\BaseUseCaseDTO;

/**
 * Class CreateCollectionInputDTO
 * @package App\UseCases\Collection\InputDTO
 */
final class CreateCollectionInputDTO extends BaseUseCaseDTO
{
    /**
     * Collection name value
     * @var string
     */
    public string $name;
}
