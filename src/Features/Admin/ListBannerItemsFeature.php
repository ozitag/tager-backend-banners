<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class ListBannerItemsFeature extends Feature
{
    private $areaId;

    public function __construct($areaId)
    {
        $this->areaId = $areaId;
    }

    public function handle()
    {
        return new SuccessResource();
    }
}
