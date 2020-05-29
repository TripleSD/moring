<?php

namespace App\Console\Commands;

use App\Models\BackupFtpList;
use App\Models\BackupFtpLogs;
use Illuminate\Console\Command;

class FtpBackupScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:ftp {--interval=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        if ($this->option('interval') === '3') {
            $interval = 3;
        } elseif ($this->option('interval') === '6') {
            $interval = 6;
        } elseif ($this->option('interval') === '12') {
            $interval = 12;
        } elseif ($this->option('interval') === '1') {
            $interval = 1;
        } else {
            $interval = 1;
        }

        $tasks = BackupFtpList::where('enabled', 1)->where('interval', $interval)->get();

        foreach ($tasks as $task) {
            $stream = ftp_connect($task->hostname);
            ftp_login($stream, $task->login, $task->password);
            ftp_pasv($stream, true);
            $files = ftp_mlsd($stream, "/$task->folder");
            ftp_close($stream);

            $status   = 0;
            $resolved = 0;

            foreach ($files as $file) {
                if ($file['name'] === $task->filename) {
                    $status   = 1;
                    $resolved = 1;
                }
            }

            $arr = [
                'task_id' => $task->id,
                'status' => $status,
                'resolved' => $resolved
            ];

            BackupFtpLogs::create($arr);
        }
    }
}
