<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Hash;
use Illuminate\Http\Request;

class SystemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        shell_exec('cat /proc/cpuinfo');
//        $os = php_uname();
//        return view('admin.settings.system.index', compact('os'));

        return view('empty');
    }
}