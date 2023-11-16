<?php

namespace App\UseCases\FileStorageSettings;

use App\Models\FileStorageSettings\DTO\FileStorageSettingsDTO;
use App\Models\FileStorageSettings\Enums\DefaultsEnum;
use App\Models\FileStorageSettings\Repositories\DatabaseRepository;
use App\UseCases\BaseUseCase;
use App\UseCases\FileStorageSettings\InputDTO\UpdateFileStorageSettingsInputDTO;

/**
 * Class UpdateFileStorageSettingsUseCase
 * @package App\UseCases\FileStorageConfiguration
 */
final class UpdateFileStorageSettingsUseCase extends BaseUseCase
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
        return UpdateFileStorageSettingsInputDTO::class;
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        /** @var UpdateFileStorageSettingsInputDTO $inputDto */
        $inputDto = $this->inputDto;
        $configurationDto = new FileStorageSettingsDTO();
        $configurationDto->systemName = DefaultsEnum::DEFAULT_SYSTEM_NAME;
        $configurationDto->key = $inputDto->key;
        $configurationDto->secret = $inputDto->secret;
        $configurationDto->region = $inputDto->region;
        $configurationDto->bucket = $inputDto->bucket;
        $configurationDto->url = $inputDto->url;
        $configurationDto->endpoint = $inputDto->endpoint;

        $this->repository->updateOrCreate($configurationDto);
    }
}
