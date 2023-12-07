<?php

namespace App\Http\Requests\Api\V1\CollectionItem;

use App\Http\Requests\Api\BaseApiRequest;
use App\Http\Requests\Api\V1\Traits\UseFileField;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Api\V1\CollectionItem
 *
 * @property string $name
 * @property array|null $file
 */
final class CreateRequest extends BaseApiRequest
{
    use UseFileField;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(
            [
                'name' => [
                    'required',
                    'string',
                ],
            ],
            $this->getFileFieldRules()
        );
    }
}
