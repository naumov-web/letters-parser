<?php

namespace App\Models\CollectionItem;

use App\Models\Base\BaseDBModel;

/**
 * Class Model
 * @package App\Models\CollectionItem
 *
 * @property int $id
 * @property int $collection_id
 * @property string $name
 */
final class Model extends BaseDBModel
{
    /**
     * Table name for model
     * @var string
     */
    protected $table = 'collection_items';
}
