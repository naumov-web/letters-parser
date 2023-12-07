<?php

namespace Tests\UseCase\CollectionItem;

use App\Models\Collection;
use App\Models\CollectionItem;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\CollectionItem\InputDTO\CreateCollectionItemInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\UseCase\BaseUseCaseTest;

/**
 * Class CreateCollectionItemUseCaseTest
 * @package Tests\UseCase\CollectionItem
 */
final class CreateCollectionItemUseCaseTest extends BaseUseCaseTest
{
    /**
     * Test success case
     *
     * @return void
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function testSuccessCase(): void
    {
        $collectionId = $this->createCollection();

        $inputDto = new CreateCollectionItemInputDTO();
        $inputDto->collectionId = $collectionId;
        $inputDto->name = 'A';

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::CREATE_COLLECTION_ITEM);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $this->assertDatabaseHas(
            (new CollectionItem\Model())->getTable(),
            [
                'collection_id' => $inputDto->collectionId,
                'name' => $inputDto->name
            ]
        );
    }

    /**
     * Test case when collection item with name already exists
     *
     * @return void
     * @throws BindingResolutionException
     * @throws UseCaseNotFoundException
     */
    public function testCaseWhenCollectionItemWithNameAlreadyExists(): void
    {
        $collectionId = $this->createCollection();

        $inputDto = new CreateCollectionItemInputDTO();
        $inputDto->collectionId = $collectionId;
        $inputDto->name = 'A';

        $this->expectException(CollectionItem\Exceptions\CollectionItemWithNameAlreadyExistsException::class);

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::CREATE_COLLECTION_ITEM);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();
        $useCase->execute();
    }

    /**
     * Create collection instance
     *
     * @return int
     */
    private function createCollection(): int
    {
        $model = Collection\Model::query()->create([
            'name' => 'Letters'
        ]);

        return $model->id;
    }
}
