<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\SystemLogs;
use App\Repositories\BridgeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

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
        $logs     = SystemLogs::with('user')
            ->orderBy('id', 'desc')
            ->paginate(50);

        $services = SystemLogs::distinct('service')->pluck('service');

        return view('admin.settings.system.index', compact('logs', 'services'));
    }
}
