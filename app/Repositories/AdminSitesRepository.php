<?php

namespace App\Repositories;

use App\Models\Sites;

class AdminSitesRepository extends Repository
{
    public function getList()
    {
        return Sites::all();
    }
}