<?php

namespace App\Models\Base\DTO;

use Illuminate\Support\Collection;

/**
 * Class ListDTO
 * @package App\Models\Base\DTO
 */
final class ListDTO
{
    /**
     * List DTO constructor
     *
     * @param Collection $items
     * @param int $count
     */
    public function __construct(public Collection $items, public int $count) {}
}
