<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\CollectionItem\CreateExampleRequest;
use App\Http\Requests\Api\V1\CollectionItem\CreateRequest;
use App\Http\Requests\Api\V1\CollectionItem\IndexRequest;
use App\Http\Resources\Api\ListResource;
use App\Http\Resources\Api\V1\CollectionItem\CollectionItemResource;
use App\Models\Base\DTO\CreateFileDTO;
use App\Models\CollectionItem\Exceptions\CollectionItemWithNameAlreadyExistsException;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\CollectionItem\GetCollectionItemsUseCase;
use App\UseCases\CollectionItem\InputDTO\CreateCollectionItemExampleInputDTO;
use App\UseCases\CollectionItem\InputDTO\CreateCollectionItemInputDTO;
use App\UseCases\CollectionItem\InputDTO\GetCollectionItemsInputDTO;
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

    /**
     * Handle request to get collection items for specific collection
     *
     * @param IndexRequest $request
     * @param int $collectionId
     * @return ListResource
     * @throws BindingResolutionException
     * @throws UseCaseNotFoundException
     */
    public function index(IndexRequest $request, int $collectionId): ListResource
    {
        $inputDto = new GetCollectionItemsInputDTO();
        $inputDto->collectionId = $collectionId;
        $inputDto->limit = $request->limit;
        $inputDto->offset = $request->offset;
        $inputDto->sortBy = $request->sortBy;
        $inputDto->sortDirection = $request->sortDirection;

        /** @var GetCollectionItemsUseCase $useCase */
        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::GET_COLLECTION_ITEMS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $listDto = $useCase->getListDto();

        return (new ListResource(null))
            ->setMessage(__('messages.collection_items_loaded_successfully'))
            ->setResourceClassName(CollectionItemResource::class)
            ->setItems($listDto->items)
            ->setCount($listDto->count);
    }

    /**
     * Handle request to create collection item example
     *
     * @param int $collectionId
     * @param int $collectionItemId
     * @param CreateExampleRequest $request
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws UseCaseNotFoundException
     */
    public function createExample(int $collectionId, int $collectionItemId, CreateExampleRequest $request): JsonResponse
    {
        $inputDto = new CreateCollectionItemExampleInputDTO();
        $inputDto->collectionItemId = $collectionItemId;
        $inputDto->file = new CreateFileDTO();
        $inputDto->file->name = $request->file['name'];
        $inputDto->file->mime = $request->file['mime'];
        $inputDto->file->content = $request->file['content'];

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::CREATE_COLLECTION_ITEM_EXAMPLE);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        return response()->json([
            'success' => true,
            'message' => __('messages.collection_item_example_created_successfully')
        ]);
    }
}
