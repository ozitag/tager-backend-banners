<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class UpdateBannerItemFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(BannerRequest $request)
    {
        return new SuccessResource();
    }
}
