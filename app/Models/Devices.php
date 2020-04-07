<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Devices extends Model
{
    protected $fillable = ['title', 'hostname', 'version', 'port', 'community', 'web_url', 'port_ssh', 'port_telnet'];

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

    public function logs(): hasMany
    {
        return $this->hasMany(DevicesLogs::class, 'device_id', 'id');
    }
}
