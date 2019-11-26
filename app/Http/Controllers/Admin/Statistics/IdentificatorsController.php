<?php

namespace App\Http\Controllers\Admin\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class IdentificatorsController extends Controller
{
    public function getIdentificator()
    {
        $identificator = Settings::where('parameter', 'identificator')->first();

        if ($identificator != null) {
            return $identificator->value;
        } else {
            return null;
        }

    }
}
