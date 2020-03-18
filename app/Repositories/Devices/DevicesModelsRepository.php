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

        if (empty($model)) {
            return $this->storeModel($modelTitle);
        }

        return $model->id;
    }

    public function getModel(string $modelTitle)
    {
        return DevicesModels::where('title', $modelTitle)->first();
    }

    public function storeModel(string $modelTitle)
    {
        $model        = new DevicesModels();
        $model->title = $modelTitle;
        $model->save();

        return $model->id;
    }
}
