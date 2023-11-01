<?php

namespace Tests\UseCase\Collection;

use App\Models\Collection\Model;
use App\UseCases\Base\Exceptions\UseCaseNotFoundException;
use App\UseCases\Collection\GetCollectionsUseCase;
use App\UseCases\Collection\InputDTO\GetCollectionsInputDTO;
use App\UseCases\UseCaseSystemNamesEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\UseCase\BaseUseCaseTest;

/**
 * Class GetCollectionsUseCaseTest
 * @package Tests\UseCase\Collection
 */
final class GetCollectionsUseCaseTest extends BaseUseCaseTest
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
        $collections_data = [
            ['name' => 'Georgian'],
            ['name' => 'English'],
            ['name' => 'Russian'],
        ];

        foreach ($collections_data as $collection_data) {
            Model::query()->create($collection_data);
        }

        $inputDto = new GetCollectionsInputDTO();
        $inputDto->sortBy = 'id';
        $inputDto->sortDirection = 'desc';

        /** @var GetCollectionsUseCase $useCase */
        $useCase = $this->useCaseFactory->createUseCase(UseCaseSystemNamesEnum::GET_COLLECTIONS);
        $useCase->setInputDTO($inputDto);
        $useCase->execute();

        $listDto = $useCase->getListDto();

        $this->assertEquals(count($collections_data), $listDto->count);
        $this->assertEquals($collections_data[2]['name'], $listDto->items[0]->name);
        $this->assertEquals($collections_data[1]['name'], $listDto->items[1]->name);
        $this->assertEquals($collections_data[0]['name'], $listDto->items[2]->name);
    }
}
