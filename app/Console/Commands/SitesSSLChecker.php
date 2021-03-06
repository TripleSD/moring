<?php

namespace App\Console\Commands;

use App\Models\SitesChecksList;
use App\Models\SitesSslCertificates;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\SslCertificate\SslCertificate;

class SitesSSLChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SitesSSLChecker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(int $site_id = null)
    {
        if ($site_id === null) {
            $checksList = SitesChecksList::with('site')
                ->where('check_ssl', 1)
                ->whereHas(
                    'site',
                    function ($q) {
                        $q->where('enabled', 1);
                    }
                )
                ->get();
        } else {
            $checksList = SitesChecksList::with('site')
                ->where([['check_ssl', 1], ['site_id', $site_id]])
                ->whereHas(
                    'site',
                    function ($q) {
                        $q->where('enabled', 1);
                    }
                )
                ->get();
        }

        foreach ($checksList as $check) {
            try {
                $certificate    = SslCertificate::createForHostName('https://' . $check->site->url);
                $issuer         = $certificate->getIssuer();                    // Let's Encrypt Authority X3
                $validStatus    = $certificate->isValid();                      // true/false
                $expirationDate = $certificate->expirationDate();               // 2020-01-26 07:19:03
                $expirationDays = $certificate->expirationDate()->diffInDays(); // 66
                $algorithm      = $certificate->getSignatureAlgorithm();        // RSA-SHA256
                $fromDate       = $certificate->validFromDate();                // 2019-10-28 07:19:03%
            } catch (\Exception $e) {
                $issuer         = null; // Let's Encrypt Authority X3
                $validStatus    = null; // true/false
                $expirationDate = null; // 2020-01-26 07:19:03
                $expirationDays = null; // 66
                $algorithm      = null; // RSA-SHA256
                $fromDate       = null; // 2019-10-28 07:19:03%
            }

            //   SSL info saving process
            if ($site_id === null) {
                $ssl = SitesSslCertificates::where('site_id', $check->site_id)->first();
            } else {
                $ssl = SitesSslCertificates::where('site_id', $site_id)->first();
            }

            if (! empty($ssl)) {
                $ssl->issuer          = $issuer;
                $ssl->valid_status    = $validStatus;
                $ssl->expiration_date = $expirationDate;
                $ssl->expiration_days = $expirationDays;
                $ssl->algorithm       = $algorithm;
                $ssl->from_date       = $fromDate;
            } else {
                $fillable = [
                    'site_id' => $check->site_id,
                    'issuer' => $issuer,
                    'valid_status' => $validStatus,
                    'expiration_date' => $expirationDate,
                    'expiration_days' => $expirationDays,
                    'algorithm' => $algorithm,
                    'from_date' => $fromDate,
                ];
                $ssl      = new SitesSslCertificates($fillable);
            }
            $ssl->updated_at = Carbon::now();
            $ssl->save();
        }
    }
}
