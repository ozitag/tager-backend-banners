<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;

class UpdateBannerAreaJob extends Job
{
    private $model;

    private $alias;

    private $label;

    private $scenario;

    public function __construct(TagerBannerArea $model, $alias, $label, $scenario)
    {
        $this->model = $model;
        $this->alias = $alias;
        $this->label = $label;
        $this->scenario = $scenario;
    }

    public function handle()
    {
        $this->model->alias = $this->alias;
        $this->model->label = $this->label;
        $this->model->scenario = $this->scenario;
        $this->model->save();

        return $this->model;
    }
}
