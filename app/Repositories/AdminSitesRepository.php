<?php

namespace App\Repositories;

use App\Models\Sites;
use App\Models\SitesChecksList;

class AdminSitesRepository extends Repository
{
    public function index($request)
    {
        if ($request->view == 'all') {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->get();
        } elseif ($request->view == '25') {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(25);
        } elseif ($request->view == '50') {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(50);
        } elseif ($request->view == '10') {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(100);
        } else {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(25);
        }
    }

    public function store(array $fillable)
    {
        $first_entry = (new Sites())->create($fillable);
        $fillable['site_id'] = $first_entry->id;
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