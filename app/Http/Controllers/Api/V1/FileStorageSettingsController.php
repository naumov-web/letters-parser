<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\FileStorageSettings\UpdateRequest;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\FileStorageSettings\InputDTO\UpdateFileStorageSettingsInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

/**
 * Class FileStorageSettingsController
 * @package App\Http\Controllers\Api\V1
 */
final class FileStorageSettingsController extends BaseApiController
{
    /**
     * Handle request to update file storage settings
     *
     * @param UpdateRequest $request
     * @return JsonResponse
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        $inputDto = new UpdateFileStorageSettingsInputDTO();
        $inputDto->key = $request->key;
        $inputDto->secret = $request->secret;
        $inputDto->region = $request->region;
        $inputDto->bucket = $request->bucket;
        $inputDto->url = $request->url;
        $inputDto->endpoint = $request->endpoint;

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::UPDATE_FILE_STORAGE_SETTINGS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        return response()->json([
            'success' => true,
        ]);
    }
}
