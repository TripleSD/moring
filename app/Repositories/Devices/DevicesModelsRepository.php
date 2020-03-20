<?php

namespace App\Repositories\Devices;

use App\Models\DevicesModels;
use App\Repositories\Repository;

class DevicesModelsRepository extends Repository
{
    /**
     * @param string $modelTitle
     * @return int
     */
    public function getModelId(string $modelTitle): int
    {
        $model = $this->getModel($modelTitle);

        if ($model === null) {
            $model = $this->storeModel($modelTitle);
        }

        return $model->id;
    }

    /**
     * @param string $modelTitle
     * @return object|null
     */
    public function getModel(string $modelTitle): ?object
    {
        return DevicesModels::where('title', $modelTitle)->first();
    }

    /**
     * @param string $modelTitle
     * @return object|null
     */
    public function storeModel(string $modelTitle): ?object
    {
        $model        = new DevicesModels();
        $model->title = $modelTitle;
        $model->save();

        return $model;
    }
}
