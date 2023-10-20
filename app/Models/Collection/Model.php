<?php

namespace App\Models\Collection;

use App\Models\Base\BaseDBModel;

/**
 * Class Model
 *
 * @property int $id
 * @property string $name
 */
final class Model extends BaseDBModel
{
    /**
     * Table name for model
     * @var string
     */
    protected $table = 'collections';
}
