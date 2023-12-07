<?php

namespace App\Models\Base\DTO;

/**
 * Class CreateFileDTO
 * @package App\Models\Base\DTO
 */
final class CreateFileDTO
{
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
     * File content value
     * @var string
     */
    public string $content;
}
