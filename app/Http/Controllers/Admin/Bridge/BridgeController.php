<?php

namespace App\Http\Controllers\Admin\Bridge;

use App\Http\Controllers\Controller;
use App\Repositories\BridgeRepository;
use App\Repositories\SettingsRepository;

class BridgeController extends Controller
{
    private $settingsRepository;
    private $bridgeRepository;

    public function __construct()
    {
        $this->settingsRepository = new SettingsRepository();
        $this->bridgeRepository = new BridgeRepository();
    }

    public function getInfo()
    {
        if ($this->settingsRepository->getIdentificator() == null) {
            $newIdentificator = $this->bridgeRepository->getNewIdentificator();
            $this->settingsRepository->updateIdentificatorParam($newIdentificator);
            $this->settingsRepository->getIdentificator();
        }

        return $this->bridgeRepository->getBridgeInfo($this->settingsRepository->getIdentificator());
    }

    public function getNewIdentificator()
    {
        return $this->bridgeRepository->getNewIdentificator();
    }
}
