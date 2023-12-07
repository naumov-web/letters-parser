<?php

namespace App\Models\File;

use App\Models\Base\BaseDBModel;

/**
 * Class Model
 * @package App\Models\File
 *
 * @property int $id
 * @property int $owner_id
 * @property string $owner_type
 * @property string $name
 * @property string $mime
 * @property string $path
 * @property int $semantic_type_id
 */
final class Model extends BaseDBModel
{
    /**
     * Table name for model
     * @var string
     */
    protected $table = 'files';
}
