<?php

use App\UseCases\Collection\CreateCollectionUseCase;
use App\UseCases\UseCaseSystemNamesEnum;

return [
        'mapping' => [
            UseCaseSystemNamesEnum::CREATE_COLLECTION => CreateCollectionUseCase::class,
        ]
    ];
