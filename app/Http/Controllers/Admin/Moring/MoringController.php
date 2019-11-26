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
            $latestBuild = MoringVersions::orderBy('build','desc')->first();
            return array('latestBuild' => $latestBuild->build,
                'latestBuildDate' => $latestBuild->created_at);
        } catch (\Exception $e) {
            return array('latestBuild' => Config::get('moring.build'),
                'latestBuildDate' => '');
        }
    }
}