<?php

namespace App\Models\FileStorageSettings;

use App\Models\Base\BaseDBModel;

/**
 * Class Model
 * @package App\Models\FileStorageConfiguration
 *
 * @property string $system_name
 * @property string $key
 * @property string $secret
 * @property string $region
 * @property string $bucket
 * @property string $url
 * @property string $endpoint
 */
final class Model extends BaseDBModel
{
    /**
     * Table name for model
     * @var string
     */
    protected $table = 'file_storage_settings';
}
