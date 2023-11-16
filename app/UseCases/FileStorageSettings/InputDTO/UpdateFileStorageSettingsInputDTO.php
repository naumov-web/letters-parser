<?php

namespace App\UseCases\FileStorageSettings\InputDTO;

use App\UseCases\Base\DTO\BaseUseCaseDTO;

/**
 * Class UpdateFileStorageConfigurationInputDTO
 * @package App\UseCases\FileStorageConfiguration\InputDTO
 */
final class UpdateFileStorageConfigurationInputDTO extends BaseUseCaseDTO
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
