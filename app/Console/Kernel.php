<?php

namespace App\Console;

use App\Console\Commands\BridgeMoringVersionChecker;
use App\Console\Commands\BridgePHPVersionsChecker;
use App\Console\Commands\ServersPings;
use App\Console\Commands\SitesChecker;
use App\Console\Commands\SitesPings;
use App\Console\Commands\SitesSSLChecker;
use App\Console\Commands\SnmpDevicesChecker;
use App\Console\Commands\SystemChecker;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SitesChecker::class,
        SitesSSLChecker::class,
        BridgeMoringVersionChecker::class,
        BridgePHPVersionsChecker::class,
        SitesPings::class,
        ServersPings::class,
        SnmpDevicesChecker::class,
        SystemChecker::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('SitesChecker')->hourly();
        $schedule->command('SitesSSLChecker')->daily();
        $schedule->command('BridgeMoringStat')->hourly();
        $schedule->command('BridgeMoringVersionChecker')->daily();
        $schedule->command('BridgePHPVersionsChecker')->daily();
        $schedule->command('SitesPings')->everyFiveMinutes();
        $schedule->command('ServersPings')->everyFiveMinutes();
        $schedule->command('SnmpDevicesChecker')->everyMinute();
        $schedule->command('SystemChecker')->daily();

        $schedule->command('scraper:ftp --interval=1')->hourly();
        $schedule->command('scraper:ftp --interval=3')->hourlyAt([0,3,6,9,12,15,18,21]);
        $schedule->command('scraper:ftp --interval=6')->hourlyAt([0,6,12,18]);
        $schedule->command('scraper:ftp --interval=12')->hourlyAt([0,12]);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
