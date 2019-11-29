<?php

namespace App\Repositories\Sites;

use App\Models\BridgePhpVersions;
use App\Models\Sites;
use App\Models\SitesSslCertificates;
use App\Repositories\Repository;

class SitesCountsRepository extends Repository
{
    public function getAllSitesCount()
    {
        return Sites::get()->count();
    }

    public function getDisabledSitesCount()
    {
        return Sites::where('enabled', 0)->count();
    }

    public function getSslExpirationsDaysSitesCount()
    {
        return SitesSslCertificates::where('expiration_days', 0)->count();
    }

    public function getSslErrorsSitesCount()
    {
        $sites = Sites::where('https', 1)->with('getSslCertification')->get();
        $count = 0;

        foreach ($sites as $site) {
            if (empty($site->getSslCertification)) {
                $count++;
            }
        }
// тут пересмотреть запрос учитывать https / учитывать ssl
        return $count;
    }

    public function getSslSuccessSitesCount()
    {
        $sites = Sites::where('https', 1)->with('getSslCertification')->get();
        $count = 0;

        foreach ($sites as $site) {
            if (!empty($site->getSslCertification)) {
                $count++;
            }
        }

        return $count;
    }

    public function getSoftwareErrorsSitesCount()
    {

        // where enabled = 1
        $sites = Sites::with('getPhpVersion')->get();
        $count = 0;

        foreach ($sites as $site) {
            if ($site->getPhpVersion->version === '0') {
                $count++;
            }
        }

        return $count;
    }

    public function getBridgeErrors()
    {
        $count = 0;

        $sites = Sites::with('getPhpVersion')->get();
        $bridgeVersions = BridgePhpVersions::pluck('branch')->toArray();
        foreach ($sites as $site) {

            if ($site->getPhpVersion->branch != 0) {
                if (!in_array($site->getPhpVersion->branch, $bridgeVersions)) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function getSoftwareVersionErrors()
    {
        $count = 0;

        $sites = Sites::with('getPhpVersion')->get();
        $bridgeBranchs = BridgePhpVersions::pluck('branch')->toArray();
        $bridgeVersions = BridgePhpVersions::get();

        foreach ($sites as $site) {
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

        return $count;
    }
}