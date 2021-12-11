<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Core\Jobs\Job;

class UpdateBannerStatusJob extends Job
{
    protected TagerBanner $model;

    public function __construct(TagerBanner $model)
    {
        $this->model = $model;
    }

    public function handle(BannersRepository $bannersRepository)
    {
        $status = TagerBannersStatus::Active;

        if ($this->model->start_at && time() < strtotime($this->model->start_at)) {
            $status = TagerBannersStatus::Waiting;
        }

        if ($this->model->finish_at && time() > strtotime($this->model->finish_at)) {
            $status = TagerBannersStatus::Archived;
        }

        return $bannersRepository->set($this->model)->fillAndSave([
            'status' => $status
        ]);
    }
}
