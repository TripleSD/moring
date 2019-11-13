<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Http\Controllers\Admin\Agent\AgentController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServersRequest;
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

    public function index(ServersRequest $request)
    {
        $servers = $this->serversRepository->getServersList($request);
        return view('admin.servers.index', compact('servers'));
    }

    public function show($serverId, AgentController $agentController)
    {
        $server = $this->serversRepository->getServer($serverId);
        $settingsFile = $agentController->getSettings();
        return view('admin.servers.show', compact('server','settingsFile'));
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