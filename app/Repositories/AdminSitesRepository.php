<?php

namespace App\Repositories;

use App\Models\Sites;
use App\Models\SitesChecksList;
use App\Models\SitesPhpVersions;

class AdminSitesRepository extends Repository
{
    public function getList($perPage = null)
    {
        $columns = ['id', 'name', 'url' , 'https', 'active', 'comment', 'http_code'];
        return Sites::with('getPhpVersion')->paginate($perPage);
    }

    public function store (array $fillable)
    {
        $first_entry = (new Sites())->create($fillable);
        $fillable['site_id'] =  $first_entry->id;
        $result = (new SitesChecksList())->create($fillable);
        return $result;
    }

    public function show($request)
    {
        $site = Sites::with('checksList')->with('getHttpCode')->find($request->id);
        return $site;
    }

    public function update($fillable, int $id)
    {
        $site = Sites::find($id);
        $result = $site->update($fillable);

        $check = SitesChecksList::where('site_id', $id)->first();
        $check->update($fillable);
        return $result;
    }

    public function destroy(int $id)
    {
        $result = Sites::destroy($id);
        return $result;
    }
}