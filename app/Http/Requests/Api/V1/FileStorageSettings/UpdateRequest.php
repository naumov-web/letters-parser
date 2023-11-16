<?php

namespace App\Http\Requests\Api\V1\FileStorageSettings;

use App\Http\Requests\Api\BaseApiRequest;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Api\V1\FileStorageSettings
 *
 * @property string $key
 * @property string $secret
 * @property string $region
 * @property string $bucket
 * @property string $url
 * @property string $endpoint
 */
final class UpdateRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => [
                'required',
                'string',
            ],
            'secret' => [
                'required',
                'string',
            ],
            'region' => [
                'required',
                'string',
            ],
            'bucket' => [
                'required',
                'string',
            ],
            'url' => [
                'required',
                'string',
            ],
            'endpoint' => [
                'required',
                'string',
            ],
        ];
    }
}
