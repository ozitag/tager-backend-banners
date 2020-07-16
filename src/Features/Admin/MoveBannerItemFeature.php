<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerByIdJob;
use OZiTAG\Tager\Backend\Banners\Jobs\MoveBannerJob;
use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class MoveBannerItemFeature extends Feature
{
    private $id;

    private $direction;

    public function __construct($id, $direction)
    {
        $this->id = $id;
        $this->direction = $direction;
    }

    public function handle()
    {
        $model = $this->run(GetBannerByIdJob::class, ['id' => $this->id]);

        $this->run(MoveBannerJob::class, ['model' => $model, 'direction' => $this->direction]);

        return new SuccessResource();
    }
}
