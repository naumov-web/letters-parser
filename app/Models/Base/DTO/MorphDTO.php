<?php

namespace App\Models\Base\DTO;

/**
 * Class MorphDTO
 * @package App\Models\Base\DTO
 */
final class MorphDTO
{
    /**
     * Owner id value
     * @var int
     */
    public int $ownerId;

    /**
     * Owner type value
     * @var string
     */
    public string $ownerType;
}
