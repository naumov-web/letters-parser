<?php

namespace App\Models\Collection\DTO;

use App\Models\Base\DTO\ModelDTO;

/**
 * Class CollectionDTO
 * @package App\Models\Collection\DTO
 */
final class CollectionDTO extends ModelDTO
{
    /**
     * Collection id value
     * @var int
     */
    public int $id;

    /**
     * Collection name value
     * @var string
     */
    public string $name;
}
