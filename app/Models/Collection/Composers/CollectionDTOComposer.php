<?php

namespace App\Models\Collection\Composers;

use App\Models\Base\Composers\BaseDTOComposer;
use App\Models\Collection\DTO\CollectionDTO;

/**
 * Class CollectionDTOComposer
 * @package App\Models\Collection\Composers
 */
final class CollectionDTOComposer extends BaseDTOComposer
{

    /**
     * @inheritDoc
     */
    function getDTOClass(): string
    {
        return CollectionDTO::class;
    }
}
