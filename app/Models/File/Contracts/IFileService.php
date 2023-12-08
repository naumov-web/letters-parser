<?php

namespace App\Models\File\Contracts;

use App\Models\Base\DTO\CreateFileDTO;
use App\Models\Base\DTO\MorphDTO;

/**
 * Class IFileService
 * @package App\Models\File\Contracts
 */
interface IFileService
{
    /**
     * Create file
     *
     * @param MorphDTO $ownerDto
     * @param CreateFileDTO $createFileDto
     * @param int $semanticTypeId
     * @return string
     */
    public function create(MorphDTO $ownerDto, CreateFileDTO $createFileDto, int $semanticTypeId): string;
}
