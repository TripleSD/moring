<?php

namespace App\Console\Commands;

use App\Models\SitesChecksList;
use App\Models\SitesSslCertifications;
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
    public function handle()
    {
        $checksList = SitesChecksList::where('check_ssl', 1)->with('site')->get();

        foreach ($checksList as $check) {
            try {
                $certificate = SslCertificate::createForHostName('https://' . $check->site->url);
                $issuer = $certificate->getIssuer(); // Let's Encrypt Authority X3
                $validStatus = $certificate->isValid(); // true/false
                $expirationDate = $certificate->expirationDate(); // 2020-01-26 07:19:03
                $expirationDays = $certificate->expirationDate()->diffInDays(); // 66
                $algorithm = $certificate->getSignatureAlgorithm(); // RSA-SHA256
                $fromDate = $certificate->validFromDate(); // 2019-10-28 07:19:03%
            } catch (\Exception $e) {
                $issuer = null; // Let's Encrypt Authority X3
                $validStatus = null; // true/false
                $expirationDate = null; // 2020-01-26 07:19:03
                $expirationDays = null; // 66
                $algorithm = null; // RSA-SHA256
                $fromDate = null; // 2019-10-28 07:19:03%
            }

            //   SSL info saving process
            $ssl = SitesSslCertifications::where('site_id', $check->site->id)->first();
            if (!empty($ssl)) {
                $ssl->issuer = $issuer;
                $ssl->valid_status = $validStatus;
                $ssl->expiration_date = $expirationDate;
                $ssl->expiration_days = $expirationDays;
                $ssl->algorithm = $algorithm;
                $ssl->from_date = $fromDate;
            } else {
                $fillable = ['site_id' => $check->site->id, 'issuer' => $issuer, 'valid_status' => $validStatus,
                    'expiration_date' => $expirationDate, 'expiration_days' => $expirationDays,
                    'algorithm' => $algorithm, 'from_date' => $fromDate];
                $ssl = new SitesSslCertifications($fillable);
            }
            $ssl->updated_at = \Carbon\Carbon::now();
            $ssl->save();
        }
    }
}
