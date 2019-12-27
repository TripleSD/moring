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
    public function checkModel(string $modelTitle): int
    {
        $model = DevicesModels::where('title', $modelTitle)->first();

        if (empty($model)) {
            $model        = new DevicesModels();
            $model->title = $modelTitle;
            $model->save();

            return $model->id;
        } else {
            return $model->id;
        }
    }
}
