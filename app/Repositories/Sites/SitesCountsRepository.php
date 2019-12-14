<?php

namespace App\Repositories\Sites;

use App\Models\BridgePhpVersions;
use App\Models\Sites;
use App\Models\SitesChecksList;
use App\Models\SitesSslCertificates;
use App\Repositories\Repository;

class SitesCountsRepository extends Repository
{
    public function getAllSitesCount()
    {
        return Sites::get();
    }

    public function getDisabledSitesCount()
    {
        return Sites::where('enabled', 0)->get();
    }

    public function getSslExpirationsDaysSitesCount()
    {
        return SitesSslCertificates::where('expiration_days', "<=", 0)->get();
    }

    public function getSslErrorsSitesCount()
    {
        $sites = Sites::join('sites_checks_list', 'sites.id', '=', 'sites_checks_list.site_id')
                        ->join('sites_ssl_certificates', 'sites.id', '=', 'sites_ssl_certificates.site_id')
                        ->where(['sites.https' => 1, 'sites.enabled' => 1, 'sites_checks_list.check_ssl' => 1, 'sites_ssl_certificates.issuer' => NULL])
                        ->orWhere(['sites_ssl_certificates.valid_status' => 0])
                        ->get();

        return $sites;
    }

    public function getSslSuccessSitesCount()
    {
        $sites = Sites::join('sites_checks_list', 'sites.id', '=', 'sites_checks_list.site_id')
            ->join('sites_ssl_certificates', 'sites.id', '=', 'sites_ssl_certificates.site_id')
            ->where(['sites.https' => 1, 'sites.enabled' => 1, 'sites_checks_list.check_ssl' => 1, 'sites_ssl_certificates.valid_status' => 1])
            ->get();

        return $sites;
    }

    public function getSoftwareErrorsSitesCount()
    {
            $query = Sites::where('enabled', 1)->with('checkPhpEnabled')->get();
            $sites = $query->filter(function ($site){
                if (!empty($site->checkPhpEnabled->getPhpErrors)){
                    return $site;
                }
            });

            return $sites;
    }

    public function getBridgeErrors()
    {
        $sites = [];
        $pre_sites = Sites::with('getPhpVersion')->get();
        $bridgeVersions = BridgePhpVersions::pluck('branch')->toArray();
        foreach ($pre_sites as $site) {
            if (!empty($site->getPhpVersion)) {
                if ($site->getPhpVersion->branch != 0) {
                    if (!in_array($site->getPhpVersion->branch, $bridgeVersions)) {
                        $sites[] = $site;
                    }
                }
            }
        }
        return $sites;
    }

    public function getSoftwareVersionErrors()
    {
        $count = 0;

        $sites = Sites::with('getPhpVersion')->get();
        $bridgeBranchs = BridgePhpVersions::pluck('branch')->toArray();
        $bridgeVersions = BridgePhpVersions::get();

        foreach ($sites as $site) {
            if (!empty($site->getPhpVersion)) {
                if ($site->getPhpVersion->version != 0) {
                    if (in_array($site->getPhpVersion->branch, $bridgeBranchs)) {
                        foreach ($bridgeVersions as $version) {
                            if ($version->branch == $site->getPhpVersion->branch) {
                                if (version_compare($site->getPhpVersion->version, $version->version) < 0) {
                                    $count++;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $sites;
    }
}
