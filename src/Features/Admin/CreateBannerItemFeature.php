<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class CreateBannerItemFeature extends Feature
{
    private $areaId;

    public function __construct($areaId)
    {
        $this->areaId = $areaId;
    }

    public function handle(BannerRequest $request)
    {
        return new SuccessResource();
    }
}
