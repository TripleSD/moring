<?php

namespace App\Repositories\Servers;

use App\Http\Requests\Admin\ServersStoreRequest;
use App\Http\Requests\Admin\ServersUpdateRequest;
use App\Models\Servers;
use App\Repositories\Repository;
use Illuminate\Support\Str;

class ServersRepository extends Repository
{
    public function getServersList($request)
    {
        if ($request->view == 'all') {
            return Servers::get();
        } elseif ($request->view == '10') {
            return Servers::paginate(10);
        } elseif ($request->view == '25') {
            return Servers::paginate(25);
        } elseif ($request->view == '50') {
            return Servers::paginate(50);
        } else {
            return Servers::paginate(10);
        }
    }

    public function getServer($serverId)
    {
        return Servers::find($serverId);
    }

    public function createToken()
    {
        return Str::random('40');
    }

    public function storeServer(ServersStoreRequest $serversRequest)
    {
        $fillData = $serversRequest->validated();

        $server = new Servers();
        $server->create($fillData);

        flash('Сервер сохранен')->success();

        return redirect(route('servers.index'));
    }

    public function updateServer(ServersUpdateRequest $serversRequest, $serverId)
    {
        $fillData = $serversRequest->validated();

        $server = Servers::find($serverId);

        if (! isset($fillData['enabled'])) {
            $server->setAttribute('enabled', 0);
        }

        $server->update($fillData);

        flash('Данные обновлены')->success();

        return redirect(route('servers.show', $serverId));
    }
}
