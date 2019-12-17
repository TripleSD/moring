<?php

namespace App\Http\Controllers\Admin\Network;

use App\Http\Controllers\Controller;

class NetworkDevicesController extends Controller
{
    public function getIndex()
    {
        return view('admin.network.devices.index');
    }
}
