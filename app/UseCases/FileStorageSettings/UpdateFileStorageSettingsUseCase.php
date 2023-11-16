<?php

namespace App\UseCases\FileStorageConfiguration;

use App\Models\FileStorageConfiguration\DTO\FileStorageConfigurationDTO;
use App\Models\FileStorageConfiguration\Enums\DefaultsEnum;
use App\Models\FileStorageConfiguration\Repositories\DatabaseRepository;
use App\UseCases\BaseUseCase;
use App\UseCases\FileStorageConfiguration\InputDTO\UpdateFileStorageConfigurationInputDTO;

/**
 * Class UpdateFileStorageConfigurationUseCase
 * @package App\UseCases\FileStorageConfiguration
 */
final class UpdateFileStorageConfigurationUseCase extends BaseUseCase
{
    /**
     * UpdateFileStorageConfigurationUseCase constructor
     * @param DatabaseRepository $repository
     */
    public function __construct(private DatabaseRepository $repository) {}

    /**
     * @inheritDoc
     */
    protected function getInputDTOClass(): ?string
    {
        return UpdateFileStorageConfigurationInputDTO::class;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        /** @var UpdateFileStorageConfigurationInputDTO $inputDto */
        $inputDto = $this->inputDto;
        $configurationDto = new FileStorageConfigurationDTO();
        $configurationDto->systemName = DefaultsEnum::DEFAULT_CONFIG_SYSTEM_NAME;
        $configurationDto->key = $inputDto->key;
        $configurationDto->secret = $inputDto->secret;
        $configurationDto->region = $inputDto->region;
        $configurationDto->bucket = $inputDto->bucket;
        $configurationDto->url = $inputDto->url;
        $configurationDto->endpoint = $inputDto->endpoint;

        $this->repository->updateOrCreate($configurationDto);
    }
}
