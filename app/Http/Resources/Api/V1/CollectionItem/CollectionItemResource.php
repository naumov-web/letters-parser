<?php

namespace App\Http\Resources\Api\V1\CollectionItem;

use App\Http\Resources\Api\BaseApiResource;
use Illuminate\Http\Request;

/**
 * Class CollectionItemResource
 * @package App\Http\Resources\Api\V1\CollectionItem
 */
final class CollectionItemResource extends BaseApiResource
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
            'collectionId' => $this->collectionId,
            'name' => $this->name,
        ];
    }
}
