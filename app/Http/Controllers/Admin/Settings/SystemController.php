<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\SystemLogs;
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
        $logs = SystemLogs::with('user')->orderBy('id', 'desc')->get();

        return view('admin.settings.system.index', compact('logs'));
    }
}
