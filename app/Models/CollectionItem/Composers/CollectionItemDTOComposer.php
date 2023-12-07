<?php

namespace App\Models\CollectionItem\Composers;

use App\Models\Base\Composers\BaseDTOComposer;
use App\Models\CollectionItem\DTO\CollectionItemDTO;

/**
 * Class CollectionItemDTOComposer
 * @package App\Models\CollectionItem\Composers
 */
final class CollectionItemDTOComposer extends BaseDTOComposer
{

    /**
     * @inheritDoc
     */
    function getDTOClass(): string
    {
        return CollectionItemDTO::class;
    }
}
