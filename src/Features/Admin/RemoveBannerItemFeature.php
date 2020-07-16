<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByIdJob;
use OZiTAG\Tager\Backend\Banners\Jobs\RemoveBannerAreaJob;

class RemoveBannerItemFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        return new SuccessResource();
    }
}
