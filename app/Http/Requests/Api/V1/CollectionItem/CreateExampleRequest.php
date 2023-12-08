<?php

namespace App\Http\Requests\Api\V1\CollectionItem;

use App\Http\Requests\Api\BaseApiRequest;
use App\Http\Requests\Api\V1\Traits\UseFileField;

/**
 * Class CreateExampleRequest
 * @package App\Http\Requests\Api\V1\CollectionItem
 *
 * @property array $file
 */
final class CreateExampleRequest extends BaseApiRequest
{
    use UseFileField;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getFileFieldRules();
    }
}
