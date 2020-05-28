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
    protected $signature = 'FtpBackupScraper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $tasks = BackupFtpList::where('enabled', 1)->get();

        foreach ($tasks as $task) {
            $filename = explode('.',$task->filename);
            $filename = $task->pre . $filename[0] . $task->post . '.' . $filename[1];

            $stream = ftp_connect($task->hostname);
            ftp_login($stream, $task->login, $task->password);
            ftp_pasv($stream, true);
            $files = ftp_mlsd($stream, "/$task->folder");
            ftp_close($stream);

            $status   = 0;
            $resolved = 0;

            foreach ($files as $file) {
                if ($file['name'] === $filename) {
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
