<?php

namespace Tests\UseCase\FileStorageSettings;

use App\Models\FileStorageSettings\Enums\DefaultsEnum;
use App\Models\FileStorageSettings\Model;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\FileStorageSettings\InputDTO\UpdateFileStorageSettingsInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\UseCase\BaseUseCaseTest;

/**
 * Class UpdateFileStorageSettingsUseCaseTest
 * @package Tests\UseCase\FileStorageSettings
 */
final class UpdateFileStorageSettingsUseCaseTest extends BaseUseCaseTest
{
    /**
     * Test case when settings don't exist
     *
     * @test
     * @return void
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function testCaseWhenSettingsDontExist(): void
    {
        $inputDto = new UpdateFileStorageSettingsInputDTO();
        $inputDto->key = 'key';
        $inputDto->secret = 'secret';
        $inputDto->region = 'region';
        $inputDto->bucket = 'bucket';
        $inputDto->url = 'url';
        $inputDto->endpoint = 'endpoint';

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::UPDATE_FILE_STORAGE_SETTINGS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $this->assertDatabaseHas(
            (new Model())->getTable(),
            [
                'system_name' => DefaultsEnum::DEFAULT_SYSTEM_NAME,
                'key' => $inputDto->key,
                'secret' => $inputDto->secret,
                'region' => $inputDto->region,
                'bucket' => $inputDto->bucket,
                'url' => $inputDto->url,
                'endpoint' => $inputDto->endpoint,
            ]
        );
    }

    /**
     * Test case when settings don't exist
     *
     * @test
     * @return void
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function testCaseWhenSettingsAlreadyExist(): void
    {
        $inputDto = new UpdateFileStorageSettingsInputDTO();
        $inputDto->key = 'key';
        $inputDto->secret = 'secret';
        $inputDto->region = 'region';
        $inputDto->bucket = 'bucket';
        $inputDto->url = 'url';
        $inputDto->endpoint = 'endpoint';

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::UPDATE_FILE_STORAGE_SETTINGS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $useCase->execute();

        $this->assertEquals(
            1,
            Model::query()->where('system_name', DefaultsEnum::DEFAULT_SYSTEM_NAME)->count()
        );
    }
}
