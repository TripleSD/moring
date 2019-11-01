<?php

namespace App\Repositories;

use App\Models\Sites;

class AdminSitesRepository extends Repository
{
    public function getList()
    {
        return Sites::all();
    }

    public function store (array $fillable)
    {
        $result = (new Sites())->create($fillable);
        return $result;
    }
}