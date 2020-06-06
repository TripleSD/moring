<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\View\View;
use App\Models\SystemLogs;
use App\Http\Controllers\Controller;
use App\Repositories\BridgeRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class SystemController.
 */
class SystemController extends Controller
{
    private $bridgeRepository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->bridgeRepository = new BridgeRepository();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $logs = SystemLogs::with('user')->orderBy('id', 'desc')->get();
        $services = SystemLogs::distinct('service')->pluck('service');

        return view('admin.settings.system.index', compact('logs', 'services'));
    }
}
