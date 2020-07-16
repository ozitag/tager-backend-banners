<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\QueueJob;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;

class UpdateBannerAreaJob
{
    private $model;

    private $alias;

    private $label;

    public function __construct(TagerBannerArea $model, $alias, $label)
    {
        $this->model = $model;
        $this->alias = $alias;
        $this->label = $label;
    }

    public function handle()
    {
        $this->model->alias = $this->alias;
        $this->model->label = $this->label;
        $this->model->save();

        return $this->model;
    }
}
