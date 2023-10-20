<?php

namespace App\Models\Base\Composers;

use App\Models\Base\BaseDBModel;
use App\Models\Base\DTO\ModelDTO;
use Illuminate\Support\Collection;

/**
 * Class BaseDTOComposer
 * @package App\Models\Base\Composers
 */
abstract class BaseDTOComposer
{
    /**
     * Get InputDTO class name
     *
     * @return string
     */
    abstract function getDTOClass(): string;

    /**
     * Get collection of InputDTO from other collection
     *
     * @param Collection $items
     * @return Collection
     */
    public function getFromCollection(Collection $items): Collection
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = $this->getFromModel($item);
        }

        return collect($result);
    }

    /**
     * Get DTO instance from model
     *
     * @param BaseDBModel $model
     * @return ModelDTO
     */
    public function getFromModel(BaseDBModel $model): ModelDTO
    {
        $className = $this->getDTOClass();
        /**
         * @var ModelDTO $result
         */
        $result = new $className();
        $result->fillFromModel($model);

        return $result;
    }
}
