<?php

namespace App\Http\Requests\Api\V1\Collection;

use App\Http\Requests\Api\BaseApiRequest;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Api\V1\Collection
 *
 * @property string $name
 */
final class CreateRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
        ];
    }
}
