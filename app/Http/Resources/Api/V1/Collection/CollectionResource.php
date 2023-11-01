<?php

namespace App\Http\Resources\Api\V1\Collection;

use App\Http\Resources\Api\BaseApiResource;
use Illuminate\Http\Request;

/**
 * Class CollectionResource
 * @package App\Http\Resources\Api\V1\Collection
 */
final class CollectionResource extends BaseApiResource
{
    /**
     * Convert object to array
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
