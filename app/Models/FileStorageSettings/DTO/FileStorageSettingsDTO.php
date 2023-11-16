<?php

namespace App\Models\FileStorageConfiguration\DTO;

use App\Models\Base\DTO\ModelDTO;

/**
 * Class FileStorageConfigurationDTO
 * @package App\Models\FileStorageConfiguration\DTO
 */
final class FileStorageConfigurationDTO extends ModelDTO
{
    /**
     * System name value
     * @var string
     */
    public string $systemName;

    /**
     * Key value
     * @var string
     */
    public string $key;

    /**
     * Secret value
     * @var string
     */
    public string $secret;

    /**
     * Region value
     * @var string
     */
    public string $region;

    /**
     * Bucket value
     * @var string
     */
    public string $bucket;

    /**
     * URL value
     * @var string
     */
    public string $url;

    /**
     * Endpoint value
     * @var string
     */
    public string $endpoint;
}
