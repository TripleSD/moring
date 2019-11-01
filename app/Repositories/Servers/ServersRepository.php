<?php

namespace App\Repositories\Servers;

use App\Http\Requests\Admin\ServersRequest;
use App\Models\Servers;
use App\Repositories\Repository;
use Illuminate\Support\Str;

class ServersRepository extends Repository
{

    public function getServersList()
    {
        return Servers::all();
    }

    public function getServer($serverId)
    {
        return Servers::find($serverId);
    }

    public function createToken()
    {
        return Str::random('40');
    }

    public function storeServer(ServersRequest $serversRequest)
    {
        $fillData = $serversRequest->validated();

        $server = new Servers();
        $server->create($fillData);

        flash('Сервер сохранен')->success();
        return redirect(route('servers.index'));
    }
}