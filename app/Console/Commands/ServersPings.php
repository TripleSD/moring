<?php

namespace App\Console\Commands;

use App\Console\Ping;
use App\Models\Servers;
use App\Models\ServersPingResponses;
use App\Models\SitesPingResponses;
use Illuminate\Console\Command;

class ServersPings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ServersPings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command script provides pings of the servers from the lists';

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
        $servers = Servers::get();
        foreach ($servers as $server) {
            $pings = Ping::pingTarget($server->addr);
            $pings['server_id'] = $server->id;
            $serverPings = new ServersPingResponses($pings);
            $serverPings->save();
        }
    }
}
