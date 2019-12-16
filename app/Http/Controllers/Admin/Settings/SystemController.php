<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Repositories\BridgeRepository;

class SystemController extends Controller
{
    private $bridgeRepository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->bridgeRepository = new BridgeRepository();
    }

    public function index()
    {
        return view('admin.settings.system.index');
    }
}
