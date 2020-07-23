<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;
use OZiTAG\Tager\Backend\Banners\Resources\BannerAreaResource;

class ListBannerAreaFeature extends Feature
{
    public function handle(BannerAreasRepository $repository)
    {
        return BannerAreaResource::collection($repository->all());
    }
}
