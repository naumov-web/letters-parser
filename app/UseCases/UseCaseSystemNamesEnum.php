<?php

namespace App\UseCases;

/**
 * Class UseCaseSystemNamesEnum
 * @package App\UseCases
 */
final class UseCaseSystemNamesEnum
{
    /**
     * Use case "Create collection"
     * @var string
     */
    public const CREATE_COLLECTION = 'createCollection';

    /**
     * Use case "Get collections"
     * @var string
     */
    public const GET_COLLECTIONS = 'getCollections';

    /**
     * Use case "Create collection item"
     * @var string
     */
    public const CREATE_COLLECTION_ITEM = 'createCollectionItem';

    /**
     * Use case "Get collection items"
     * @var string
     */
    public const GET_COLLECTION_ITEMS = 'getCollectionItems';

    /**
     * Use case "Create collection item example"
     * @var string
     */
    public const CREATE_COLLECTION_ITEM_EXAMPLE = 'createCollectionItemExample';
}
