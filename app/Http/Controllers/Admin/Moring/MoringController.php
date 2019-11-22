<?php

namespace App\Http\Controllers\Admin\Moring;

use App\Http\Controllers\Controller;
use App\Models\MoringVersions;
use Illuminate\Support\Facades\Config;

class MoringController extends Controller
{
    public function getInfo()
    {
        try {
            $availiblesVersions = MoringVersions::orderBy('version', 'desc')->first();
            return array('currentVersion' => $availiblesVersions->version,
                'currentHumanVersion' => $availiblesVersions->human_version);
        } catch (\Exception $e) {
            return array('currentVersion' => Config::get('moring.version'),
                'currentHumanVersion' => Config::get('moring.humanVersion'));
        }
    }
}