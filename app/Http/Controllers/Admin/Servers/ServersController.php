<?php


namespace App\Http\Controllers\Admin\Servers;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServersRequest;
use App\Models\Servers;
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

    public function edit()
    {

    }

    public function create()
    {
        $token = $this->serversRepository->createToken();
        return view('admin.servers.create', compact('token'));
    }

    public function store(ServersRequest $serversRequest)
    {
        return $this->serversRepository->storeServer($serversRequest);
    }
}