<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;

class RemoveBannerAreaJob
{
    private $model;

    public function __construct(TagerBannerArea $model)
    {
        $this->model = $model;
    }

    public function handle(BannerAreasRepository $repository)
    {
        return $this->model->delete();
    }
}
