<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;

class RemoveBannerAreaJob extends Job
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
