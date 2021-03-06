<?php

namespace App\Repositories\Sites;

use App\Models\BridgePhpVersions;
use App\Models\Sites;
use App\Repositories\Repository;

class SitesCountsRepository extends Repository
{
    public function getAllSitesCount()
    {
        return Sites::where('enabled', 1)->get();
    }

    public function getDisabledSitesCount()
    {
        return Sites::where('enabled', 0)->get();
    }

    public function getSslExpirationsDaysSitesCount()
    {
        return Sites::join('sites_checks_list', 'sites.id', '=', 'sites_checks_list.site_id')
            ->leftJoin('sites_ssl_certificates', 'sites_checks_list.id', '=', 'sites_ssl_certificates.site_id')
            ->where('expiration_days', '<=', 0)->get();
    }

    public function getSslErrorsSitesCount()
    {
        $sites = Sites::join('sites_checks_list', 'sites.id', '=', 'sites_checks_list.site_id')
            ->join('sites_ssl_certificates', 'sites.id', '=', 'sites_ssl_certificates.site_id')
            ->where(
                [
                    'sites.https' => 1,
                    'sites.enabled' => 1,
                    'sites_checks_list.check_ssl' => 1,
                    'sites_ssl_certificates.issuer' => null,
                ]
            )
            ->orWhere(['sites_ssl_certificates.valid_status' => 0])
            ->get();

        return $sites;
    }

    public function getSslSuccessSitesCount()
    {
        $sites = Sites::join('sites_checks_list', 'sites.id', '=', 'sites_checks_list.site_id')
            ->join('sites_ssl_certificates', 'sites.id', '=', 'sites_ssl_certificates.site_id')
            ->where(
                [
                    'sites.https' => 1,
                    'sites.enabled' => 1,
                    'sites_checks_list.check_ssl' => 1,
                    'sites_ssl_certificates.valid_status' => 1,
                ]
            )
            ->get();

        return $sites;
    }

    public function getSoftwareErrorsSitesCount()
    {
        $query = Sites::where('enabled', 1)->with('checkPhpEnabled')->get();
        $sites = $query->filter(
            function ($site) {
                if (! empty($site->checkPhpEnabled->getPhpErrors)) {
                    return $site;
                }
            }
        );

        return $sites;
    }

    public function getBridgeErrors()
    {
        $sites          = [];
        $presites       = Sites::join('sites_checks_list', 'sites.id', '=', 'sites_checks_list.site_id')
            ->leftJoin('sites_php_versions', 'sites_checks_list.site_id', '=', 'sites_php_versions.site_id')
            ->where(['sites.enabled' => 1, 'sites_checks_list.check_php' => 1])
            ->where('sites_php_versions.branch', '<>', 0)
            ->get();
        $bridgeVersions = BridgePhpVersions::pluck('branch')->toArray();
        foreach ($presites as $site) {
            if (! in_array($site->branch, $bridgeVersions)) {
                $sites[] = $site;
            }
        }

        return $sites;
    }

    public function getDeprecatedVersions()
    {
        // Get all enabled and not deleted sites with php versions
        $allSites = Sites::with('getPhpVersion')
            ->whereNull('deleted_at')
            ->where('enabled', 1)
            ->get();

        // Get all deprecated PHP versions (version + branch)
        $deprecatedVersions = BridgePhpVersions::where('deprecated_status', 1)->pluck('version')->toArray();

        //Create empty array for result
        $sites = [];

        // Get needing sites by condition
        foreach ($allSites as $site) {
            if (in_array($site->getPhpVersion->version, $deprecatedVersions)) {
                $sites[] = $site;
            }
        }

        return $sites;
    }
}
