<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServersStoreRequest;
use App\Http\Requests\Admin\ServersUpdateRequest;
use App\Repositories\Servers\ServersRepository;

class ServersController extends Controller
{
    /**
     * @var ServersRepository
     */
    private $serversRepository;

    public function __construct(ServersRepository $serversRepository)
    {
        $this->serversRepository = $serversRepository;
    }

    public function index()
    {
        $servers = $this->serversRepository->getServersList();
        return view('admin.servers.index', compact('servers'));
    }

    public function show($serverId)
    {
        $server = $this->serversRepository->getServer($serverId);
        return view('admin.servers.show', compact('server'));
    }

    public function edit($serverId)
    {
        $server = $this->serversRepository->getServer($serverId);
        return view('admin.servers.edit', compact('server'));
    }

    public function create()
    {
        $token = $this->serversRepository->createToken();
        return view('admin.servers.create', compact('token'));
    }

    public function store(ServersStoreRequest $serversRequest)
    {
        return $this->serversRepository->storeServer($serversRequest);
    }

    public function update(ServersUpdateRequest $serversRequest, $serverId)
    {
        return $this->serversRepository->updateServer($serversRequest, $serverId);
    }
}