<?php

namespace App\Repositories;

use App\Models\ChecksSites;

class SitesRepository extends Repository
{
    public function getList()
    {
        return Sites::all();
    }
}