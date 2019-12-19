<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Devices extends Model
{
    public function firmware(): belongsTo
    {
        return $this->belongsTo(DevicesFirmwares::class, 'firmware_id', 'id');
    }

    public function model(): belongsTo
    {
        return $this->belongsTo(DevicesModels::class, 'model_id', 'id');
    }
}
