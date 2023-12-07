<?php

namespace App\Models\CollectionItem\DTO;

use App\Models\Base\DTO\ModelDTO;

/**
 * Class CollectionItemDTO
 * @package App\Models\CollectionItem\DTO
 */
final class CollectionItemDTO extends ModelDTO
{
    /**
     * Collection item id value
     * @var int
     */
    public int $id;

    /**
     * Collection id value
     * @var int
     */
    public int $collectionId;

    /**
     * Collection name value
     * @var string
     */
    public string $name;
}
