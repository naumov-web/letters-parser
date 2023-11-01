<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\V1\Collection\CreateRequest;
use App\Http\Requests\Api\V1\Collection\IndexRequest;
use App\Http\Resources\Api\ListResource;
use App\Http\Resources\Api\V1\Collection\CollectionResource;
use App\Models\Collection\Exceptions\CollectionWithNameAlreadyExistsException;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\Collection\GetCollectionsUseCase;
use App\UseCases\Collection\InputDTO\CreateCollectionInputDTO;
use App\UseCases\Collection\InputDTO\GetCollectionsInputDTO;
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

    /**
     * Handle request to get collections list
     *
     * @param IndexRequest $request
     * @return ListResource
     * @throws BindingResolutionException
     * @throws UseCaseNotFoundException
     */
    public function index(IndexRequest $request): ListResource
    {
        $inputDto = new GetCollectionsInputDTO();
        $inputDto->limit = $request->limit;
        $inputDto->offset = $request->offset;
        $inputDto->sortBy = $request->sortBy;
        $inputDto->sortDirection = $request->sortDirection;

        /** @var GetCollectionsUseCase $useCase */
        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::GET_COLLECTIONS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $listDto = $useCase->getListDto();

        return (new ListResource(null))
            ->setMessage(__('messages.collections_loaded_successfully'))
            ->setResourceClassName(CollectionResource::class)
            ->setItems($listDto->items)
            ->setCount($listDto->count);
    }
}
