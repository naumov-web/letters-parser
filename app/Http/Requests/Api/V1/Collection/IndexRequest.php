<?php

namespace App\Http\Requests\Api\V1\Collection;

use App\Http\Requests\Api\BaseListRequest;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Api\V1\Collection
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
            'createdAt'
        ]);
    }
}
