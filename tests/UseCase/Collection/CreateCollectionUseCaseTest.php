<?php

namespace Tests\UseCase\Collection;

use App\Models\Collection\Exceptions\CollectionWithNameAlreadyExistsException;
use App\Models\Collection\Model;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\Collection\InputDTO\CreateCollectionInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\UseCase\BaseUseCaseTest;

/**
 * Class CreateCollectionUseCaseTest
 * @package Tests\UseCase\Collection
 */
final class CreateCollectionUseCaseTest extends BaseUseCaseTest
{
    /**
     * Test case when collection with name already exists
     *
     * @test
     * @return void
     * @throws UseCaseNotFoundException
     * @throws BindingResolutionException
     */
    public function testCaseWhenCollectionWithNameAlreadyExists(): void
    {
        $createCollectionInputDto = new CreateCollectionInputDTO();
        $createCollectionInputDto->name = 'Collection';

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::CREATE_COLLECTION);
        $useCase->setInputDTO($createCollectionInputDto);
        $useCase->execute();

        $this->expectException(CollectionWithNameAlreadyExistsException::class);

        $useCase->execute();

        $this->assertDatabaseHas(
            (new Model())->getTable(),
            [
                'name' => $createCollectionInputDto->name,
            ]
        );
    }

    /**
     * Test success case
     *
     * @test
     * @return void
     * @throws BindingResolutionException
     * @throws UseCaseNotFoundException
     */
    public function testSuccessCase(): void
    {
        $createCollectionInputDto = new CreateCollectionInputDTO();
        $createCollectionInputDto->name = 'Collection';

        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::CREATE_COLLECTION);
        $useCase->setInputDTO($createCollectionInputDto);
        $useCase->execute();

        $this->assertDatabaseHas(
            (new Model())->getTable(),
            [
                'name' => $createCollectionInputDto->name,
            ]
        );
    }
}
