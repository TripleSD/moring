<?php

namespace App\Repositories\Backups;

use Illuminate\Http\Request;
use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use App\Models\BackupYandexConnectorsLogs;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\System\SystemLogRepository;

/**
 * Class YandexConnectorsRepository.
 */
class YandexConnectorRepository extends Repository
{
    private $backupYandexConnectors;
    private $systemLog;

    public function __construct()
    {
        $this->systemLog              = new SystemLogRepository();
        $this->backupYandexConnectors = new BackupYandexConnectors();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getList()
    {
        return BackupYandexConnectors::with('logs')->orderBy('id', 'desc')->get();
    }

    /**
     * @return mixed
     */
    public function getPluckList()
    {
        return BackupYandexConnectors::pluck('description', 'id');
    }

    /**
     * @param $request
     * @return bool
     */
    public function refreshState($request)
    {
        /* @var $request Request */

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
            $this->systemLog->createServiceEvent(
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
        $this->systemLog->createServiceEvent(
            __FUNCTION__,
            \Config::get('moring.service_yandex_disk'),
            $httpcode,
            $request->method() . PHP_EOL . $res['error'] . PHP_EOL . $url
        );

        return false;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->backupYandexConnectors->create($data);
    }

    /**
     * @param $connectorId
     * @param $data
     * @return bool
     */
    public function update($connectorId, $data)
    {
        $this->backupYandexConnectors->where('id', $connectorId)->update($data);

        return $this->backupYandexConnectors->update($data);
    }
}
