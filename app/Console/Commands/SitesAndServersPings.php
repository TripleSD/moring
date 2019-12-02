<?php

namespace App\Console\Commands;

use App\Console\Ping;
use App\Models\SitesPingResponses;
use Illuminate\Console\Command;
use App\Models\Sites;

class SitesAndServersPings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SitesAndServersPings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command script provides pings of the sites and servers from the lists';

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
        $sites = Sites::get();
        foreach ($sites as $site) {
            $pings = Ping::pingTarget($site->url);
            $pings['site_id'] = $site->id;
            $sitePings = new SitesPingResponses($pings);
            $sitePings->save();
        }
    }
}
