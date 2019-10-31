<?php

namespace App\Repositories;

use App\Models\ChecksSites;

class CheckSitesRepository extends Repository
{
    public function getList()
    {
        return ChecksSites::all();
    }


}