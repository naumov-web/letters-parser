<?php

namespace App\Http\Requests\Api\V1\CollectionItem;

use App\Http\Requests\Api\BaseListRequest;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Api\V1\CollectionItem
 */
final class IndexRequest extends BaseListRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getListRules([
            'id',
            'name',
        ]);
    }
}
