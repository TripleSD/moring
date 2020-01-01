<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Devices extends Model
{
    protected $fillable = ['title', 'hostname', 'snmp_version', 'snmp_port', 'snmp_community'];

    public function firmware(): belongsTo
    {
        return $this->belongsTo(DevicesFirmwares::class, 'firmware_id', 'id');
    }

    public function model(): belongsTo
    {
        return $this->belongsTo(DevicesModels::class, 'model_id', 'id');
    }

    public function vendor(): belongsTo
    {
        return $this->belongsTo(DevicesVendors::class, 'vendor_id', 'id');
    }

    public function logs()
    {
        return $this->belongsTo(DevicesLogs::class, 'id', 'device_id');
    }
}
