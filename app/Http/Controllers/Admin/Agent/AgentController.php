<?php

namespace App\Http\Controllers\Admin\Agent;

use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    public function getSettings()
    {
        return array(
            '<?php',
            '$array = [];'.PHP_EOL,
            'array[\'osFamily\'] = PHP_OS;'.PHP_EOL,
            'array[\'os_famile\'] = php_uname();'.PHP_EOL,
            '$array[\'php_version\'] = PHP_VERSION_ID;'.PHP_EOL,
            '$array[\'moring_version\'] = '.\Config::get('moring.version').';'.PHP_EOL,
            '$array[\'timestamp\'] = time();'.PHP_EOL,
            '$array[\'server_info\'] = $_SERVER[\'SERVER_SOFTWARE\'];'.PHP_EOL,
            'echo json_encode($array);',
        );
    }
}