<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CollectionItem\CreateRequest;
use App\Models\Base\DTO\CreateFileDTO;
use App\Models\CollectionItem\Exceptions\CollectionItemWithNameAlreadyExistsException;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\CollectionItem\InputDTO\CreateCollectionItemInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class CollectionItemController
 * @package App\Http\Controllers\Api\V1
 */
final class CollectionItemController extends BaseApiController
{
    /**
     * Handle request to create collection item
     *
     * @param CreateRequest $request
     * @param int $collectionId
     * @return JsonResponse
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function create(CreateRequest $request, int $collectionId): JsonResponse
    {
        $inputDto = new CreateCollectionItemInputDTO();
        $inputDto->collectionId = $collectionId;
        $inputDto->name = $request->name;

        if ($request->file) {
            $inputDto->file = new CreateFileDTO();
            $inputDto->file->name = $request->file['name'];
            $inputDto->file->mime = $request->file['mime'];
            $inputDto->file->content = $request->file['content'];
        }

        try {
            $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::CREATE_COLLECTION_ITEM);
            $useCase->setInputDTO($inputDto);
            $useCase->execute();
        } catch (CollectionItemWithNameAlreadyExistsException) {
            return response()->json(
                [
                    'errors' => [
                        'name' => [
                            __('validation.collection_item_with_this_name_already_exists')
                        ]
                    ]
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return response()->json([
            'success' => true,
            'message' => __('messages.collection_item_created_successfully')
        ]);
    }
}
