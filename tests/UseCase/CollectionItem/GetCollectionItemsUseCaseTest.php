<?php

namespace Tests\UseCase\CollectionItem;

use App\Models\Collection;
use App\Models\CollectionItem;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\CollectionItem\GetCollectionItemsUseCase;
use App\UseCases\CollectionItem\InputDTO\GetCollectionItemsInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\UseCase\BaseUseCaseTest;

/**
 * Class GetCollectionItemsUseCaseTest
 * @package Tests\UseCase\CollectionItem
 */
final class GetCollectionItemsUseCaseTest extends BaseUseCaseTest
{
    /**
     * Collections data list
     * @var array
     */
    protected array $collectionsData = [
        [
            'name' => 'Georgian letters'
        ],
        [
            'name' => 'English letters'
        ],
    ];

    /**
     * Collection items data list
     * @var array
     */
    protected array $collectionItemsData = [
        [
            'name' => 'A',
        ],
        [
            'name' => 'B',
        ]
    ];

    /**
     * Test success case
     *
     * @return void
     * @throws BindingResolutionException
     * @throws UseCaseNotFoundException
     */
    public function testSuccessCase(): void
    {
        $collectionId = $this->createCollection();
        $this->createCollectionItems($collectionId);

        $inputDto = new GetCollectionItemsInputDTO();
        $inputDto->collectionId = $collectionId;
        $inputDto->sortBy = 'id';
        $inputDto->sortDirection = 'asc';

        /** @var GetCollectionItemsUseCase $useCase */
        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::GET_COLLECTION_ITEMS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $listDto = $useCase->getListDto();

        $this->assertEquals(
            2,
            $listDto->count
        );
        $this->assertCount(
            2,
            $listDto->items
        );
        $this->assertEquals(
            'A',
            $listDto->items[0]->name
        );
        $this->assertEquals(
            'B',
            $listDto->items[1]->name
        );
    }

    /**
     * Test case when collection doesn't have items
     *
     * @return void
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function testCaseWhenCollectionDoesntHaveItems(): void
    {
        $firstCollectionId = $this->createCollection();
        $secondCollectionId = $this->createCollection($index = 1);
        $this->createCollectionItems($firstCollectionId);

        $inputDto = new GetCollectionItemsInputDTO();
        $inputDto->collectionId = $secondCollectionId;

        /** @var GetCollectionItemsUseCase $useCase */
        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::GET_COLLECTION_ITEMS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $listDto = $useCase->getListDto();

        $this->assertEquals(
            0,
            $listDto->count
        );
        $this->assertCount(
            0,
            $listDto->items
        );
    }

    /**
     * Create collection
     *
     * @param int $index
     * @return int
     */
    private function createCollection(int $index = 0): int
    {
        $model = Collection\Model::query()->create(
            $this->collectionsData[$index]
        );

        return $model->id;
    }

    /**
     * Create collection items
     *
     * @param int $collectionId
     * @return void
     */
    private function createCollectionItems(int $collectionId): void
    {
        foreach ($this->collectionItemsData as $collectionItemData) {
            CollectionItem\Model::query()->create(
                array_merge(
                    $collectionItemData,
                    [
                        'collection_id' => $collectionId
                    ]
                )
            );
        }
    }
}
