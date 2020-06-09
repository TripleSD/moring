<?php

namespace App\Http\Controllers;

use App\Repositories\System\SystemLogRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $systemLog;

    public function __construct()
    {
        $this->systemLog = new SystemLogRepository();
    }
}
