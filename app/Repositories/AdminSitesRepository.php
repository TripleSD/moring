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
        } elseif ($request->view == '10') {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(10);
        } elseif ($request->view == '25') {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(25);
        } elseif ($request->view == '50') {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(50);
        } else {
            return Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->paginate(10);
        }
    }

    public function store(array $fillable)
    {
        //   Now we check, if checkbox https selected otherwise we set check_ssl and check_https to zero
        if(intval($fillable['https']) === 0){
            $fillable['check_ssl'] = 0;
            $fillable['check_https'] = 0;
        }else {
            $fillable['check_https'] = 1;
        }

        //    Now we activate Moring file usage, if path has been added
        if(strlen($fillable['file_url']) >= 5){
            $fillable['use_file'] = 1;
        }

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
        //   Now we check, if checkbox https selected otherwise we set check_ssl and check_https to zero
        if(intval($fillable['https']) === 0){
            $fillable['check_ssl'] = 0;
            $fillable['check_https'] = 0;
        } else {
            $fillable['check_https'] = 1;
        }
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

    public function sortedList(int $length = null, string $sort = null)
    {
        if (is_null($length)){
            $list =  Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->orderBy('created_at', $sort)->get();
        } else {
            $list =  Sites::with('getHttpCode', 'checksList', 'getPhpVersion', 'getWebServer',
                'getSslCertification')->orderBy('created_at', $sort)->get()->slice(0, $length);
        }
        return $list;
    }
}