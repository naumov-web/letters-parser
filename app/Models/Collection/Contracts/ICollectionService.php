<?php

namespace App\Models\Collection\Contracts;

/**
 * Interface ICollectionService
 * @package App\Models\Collection\Contracts
 */
interface ICollectionService
{
    /**
     * Create collection instance
     *
     * @param string $name
     * @return mixed
     */
    public function create(string $name);
}
