<?php

namespace App\Repositories;

use App\Models\Sites;
use App\Models\SitesChecksList;
use App\Models\SitesPingResponses;
use GuzzleHttp\Client;

class AdminSitesRepository extends Repository
{
    public function index($request)
    {
        if ($request->view == 'all') {
            return Sites::with(
                'getHttpCode',
                'checksList',
                'getPhpVersion',
                'getWebServer',
                'getSslCertification'
            )->get();
        } elseif ($request->view == '10') {
            return Sites::with(
                'getHttpCode',
                'checksList',
                'getPhpVersion',
                'getWebServer',
                'getSslCertification'
            )->paginate(10);
        } elseif ($request->view == '25') {
            return Sites::with(
                'getHttpCode',
                'checksList',
                'getPhpVersion',
                'getWebServer',
                'getSslCertification'
            )->paginate(25);
        } elseif ($request->view == '50') {
            return Sites::with(
                'getHttpCode',
                'checksList',
                'getPhpVersion',
                'getWebServer',
                'getSslCertification'
            )->paginate(50);
        } else {
            return Sites::with(
                'getHttpCode',
                'checksList',
                'getPhpVersion',
                'getWebServer',
                'getSslCertification'
            )->paginate(10);
        }
    }

    public function store(array $fillable)
    {
        // Now we check, if checkbox https selected otherwise we set check_ssl and check_https to zero
        if (isset($fillable['https']) === false) {
            $fillable['https']       = 0;
            $fillable['check_ssl']   = 0;
            $fillable['check_https'] = 0;
        } else {
            $fillable['check_https'] = 1;
        }

        $fillable['enabled'] = 1;

        // Get ip address
        $fillable['ip_address'] = gethostbyname($fillable['url']);

        // Add pending status until first check is running
        $fillable['pending'] = 1;

        // Save information
        $first_entry         = (new Sites())->create($fillable);
        $fillable['site_id'] = $first_entry->id;
        $result              = (new SitesChecksList())->create($fillable);

        return $result;
    }

    public function show($request)
    {
        $site = Sites::with('checksList')->with('getHttpCode')->find($request->id);

        return $site;
    }

    public function update($fillable, int $id)
    {
        if (! isset($fillable['https'])) {
            $fillable['https']       = 0;
            $fillable['check_ssl']   = 0;
            $fillable['check_https'] = 0;
        }

        if (! isset($fillable['enabled'])) {
            $fillable['enabled'] = 0;
        }

        if (! isset($fillable['use_file'])) {
            $fillable['use_file'] = 0;
        }

        // Get ip address
        $fillable['ip_address'] = gethostbyname($fillable['url']);

        $site   = Sites::find($id);
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
        if ($length === null) {
            $list = Sites::with(
                'getHttpCode',
                'checksList',
                'getPhpVersion',
                'getWebServer',
                'getSslCertification',
                'getNewSitePing'
            )->orderBy('created_at', $sort)->get();
        } else {
            $list = Sites::with(
                'getHttpCode',
                'checksList',
                'getPhpVersion',
                'getWebServer',
                'getSslCertification',
                'getNewSitePing'
            )->orderBy('created_at', $sort)->limit($length)->get();
        }

        return $list;
    }

    public function listOfPings($request, int $count)
    {
        $list = SitesPingResponses::where('site_id', $request->id)->orderBy('created_at', 'asc')->get(
            ['average', 'created_at']
        )->slice(0, $count);

        return $list;
    }

    public function getWebServersForNew(int $count)
    {
        $list       = Sites::where('pending', '<>', 1)->with('getWebServer')->orderBy('created_at', 'desc')
            ->get(['id', 'title'])->slice(0, $count);
        $webCounter = collect();
        $list->map(
            function ($item) use ($webCounter) {
                $name = $item->getWebServer->web_server;
                if (! $webCounter->has($name)) {
                    $webCounter->put($name, 1);
                } else {
                    $add = $webCounter->get($name) + 1;
                    $webCounter->put($name, $add);
                }
            }
        );

        return $webCounter;
    }

    public function switch(array $request)
    {
        // Now we check, if checkbox https selected otherwise we set check_ssl and check_https to zero
        $site          = Sites::find($request['id']);
        $site->enabled = (int) ($request['on']);
        $result        = $site->update();

        return $result;
    }

    public function checkUrl($array)
    {
        $url      = $array['url'];
        $file_url = $array['file_url'];
        $https    = $array['https'];

        $url = ($https) ? 'https://' . $url . '/' . $file_url : 'http://' . $url . '/' . $file_url;

        try {
            $httpClient = new Client();
            $response   = $httpClient->request('GET', $url, ['allow_redirects' => false]);

            if ($response->getStatusCode() === 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $request
     * @return bool
     */
    public function checkErrorDnsDomain($request)
    {
        if (checkdnsrr($request->url, 'A')) {
            return false;
        }

        return true;
    }
}
