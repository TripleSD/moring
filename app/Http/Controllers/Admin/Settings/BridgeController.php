<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\BridgePhpVersions;
use App\Models\MoringVersions;
use App\Repositories\BridgeRepository;
use Artisan;

class BridgeController extends Controller
{
    private $bridgeRepostitory;

    public function __construct()
    {
        $this->bridgeRepostitory = new BridgeRepository();
    }

    public function getIndex()
    {
        $bridgeStatistics = $this->bridgeRepostitory->getBridgeStatistics();
        $phpLinesCount = BridgePhpVersions::count();
        $moringLinesCount = MoringVersions::count();
        return view('admin.settings.bridge.index', compact('bridgeStatistics',
        'phpLinesCount','moringLinesCount'));
    }

    public function updateInfo()
    {
        Artisan::call('BridgeMoringVersionChecker');
        Artisan::call('BridgePHPVersionsChecker');

        flash('Данные обновлены')->success();
        return redirect()->route('settings.bridge.index');
    }
}
