<?php

use App\UseCases\Collection\CreateCollectionUseCase;
use App\UseCases\Collection\GetCollectionsUseCase;
use App\UseCases\CollectionItem\CreateCollectionItemUseCase;
use App\UseCases\UseCaseSystemNamesEnum;

return [
        'mapping' => [
            UseCaseSystemNamesEnum::CREATE_COLLECTION => CreateCollectionUseCase::class,
            UseCaseSystemNamesEnum::GET_COLLECTIONS => GetCollectionsUseCase::class,
            UseCaseSystemNamesEnum::CREATE_COLLECTION_ITEM => CreateCollectionItemUseCase::class,
        ]
    ];
