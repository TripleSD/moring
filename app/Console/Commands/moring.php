<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class moring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moring:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install MoRinG system.';

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
        echo 'hello';
    }
}
