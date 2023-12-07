<?php

namespace App\Models\File\DTO;

use App\Models\Base\DTO\ModelDTO;

/**
 * Class FileDTO
 * @package App\Models\File\DTO
 */
final class FileDTO extends ModelDTO
{
    /**
     * File id value
     * @var int
     */
    public int $id;

    /**
     * File owner id value
     * @var int
     */
    public int $ownerId;

    /**
     * File owner type value
     * @var string
     */
    public string $ownerType;

    /**
     * File name value
     * @var string
     */
    public string $name;

    /**
     * File mime value
     * @var string
     */
    public string $mime;

    /**
     * File path value
     * @var string
     */
    public string $path;

    /**
     * File semantic type id value
     * @var int
     */
    public int $semanticTypeId;
}
