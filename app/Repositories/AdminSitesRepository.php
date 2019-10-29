<?php

namespace App\Repositories;

use App\Models\ChecksSites;

class AdminSitesRepository extends Repository
{
    public function getList()
    {
        return Sites::all();
    }
}