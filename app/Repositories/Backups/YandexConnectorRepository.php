<?php

namespace App\Repositories\Backups;

use App\Helpers\SystemLog;
use Illuminate\Http\Request;
use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use App\Models\BackupYandexConnectorsLogs;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class YandexConnectorsRepository.
 */
class YandexConnectorRepository extends Repository
{
    private $backupYandexConnectors;

    public function __construct()
    {
        $this->backupYandexConnectors = new BackupYandexConnectors();
    }

    /**
     * @param $request
     * @return Builder[]|Collection
     */
    public function getList($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexConnectors::with(
            [
                'logs' => function ($q) {
                    return $q->where('resolved', 0);
                },
            ]
        )
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getPluckList($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexConnectors::pluck('description', 'id');
    }

    /**
     * @param $request
     * @return bool
     */
    public function refreshState($request)
    {
        /* @var $request Request */

        SystemLog::createUserEvent(__FUNCTION__, $request);

        $connector = BackupYandexConnectors::find($request->id);
        $url       = 'https://cloud-api.yandex.net/v1/disk/';
        $ch        = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: OAuth ' . $connector->token]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res      = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        $res = json_decode($res, true);

        if ($httpcode === 200) {
            BackupYandexConnectors::where('id', $connector->id)->update(
                [
                    'total_space' => $res['total_space'],
                    'trash_size' => $res['trash_size'],
                    'used_space' => $res['used_space'],
                    'http_code' => $httpcode,
                    'status' => 1,
                ]
            );

            // Insert event to fail log
            BackupYandexConnectorsLogs::create(['connector_id' => $connector->id, 'status' => 1, 'resolved' => 1,]);

            // Insert event to system log
            SystemLog::createServiceEvent(
                __FUNCTION__,
                \Config::get('moring.service_yandex_disk'),
                $httpcode,
                $request->method() . PHP_EOL . $url
            );

            return true;
        }

        // Insert event to fail log
        BackupYandexConnectors::where('id', $connector->id)->update(
            [
                'http_code' => $httpcode,
                'status' => 0,
            ]
        );

        BackupYandexConnectorsLogs::create(['connector_id' => $connector->id, 'status' => 0, 'resolved' => 0,]);

        // Insert event to system log
        SystemLog::createServiceEvent(
            __FUNCTION__,
            \Config::get('moring.service_yandex_disk'),
            $httpcode,
            $request->method() . PHP_EOL . $res['error'] . PHP_EOL . $url
        );

        return false;
    }

    /**
     * @param $request
     * @param $data
     * @return mixed
     */
    public function store($request, $data)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return $this->backupYandexConnectors->create($data);
    }

    /**
     * @param $request
     * @param $data
     * @return bool
     */
    public function update($request, $data)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        $this->backupYandexConnectors->where('id', $request->id)->update($data);

        return $this->backupYandexConnectors->update($data);
    }
}
