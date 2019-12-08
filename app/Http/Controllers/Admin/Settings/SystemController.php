<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Repositories\BridgeRepository;
use Hash;
use Illuminate\Http\Request;

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
        $bridgeStatistics = $this->bridgeRepository->getBridgeStatistics();
        $os = php_uname();
        return view('admin.settings.system.index', compact('os','bridgeStatistics'));
    }
}
