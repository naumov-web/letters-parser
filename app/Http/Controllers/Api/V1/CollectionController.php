<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\Collection\CreateRequest;
use App\Models\Collection\Exceptions\CollectionWithNameAlreadyExistsException;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\Collection\InputDTO\CreateCollectionInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class CollectionController
 * @package App\Http\Controllers\Api\V1
 */
final class CollectionController extends BaseApiController
{
    /**
     * Handle request to create collection
     *
     * @param CreateRequest $request
     * @return JsonResponse
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $inputDto = new CreateCollectionInputDTO();
        $inputDto->name = $request->name;

        try {
            $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::CREATE_COLLECTION);
            $useCase->setInputDTO($inputDto);
            $useCase->execute();
        } catch (CollectionWithNameAlreadyExistsException) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => [
                        'name' => [
                            __('validation.collection_with_this_name_already_exists')
                        ]
                    ]
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => __('messages.collection_created_successfully')
            ]
        );
    }
}
