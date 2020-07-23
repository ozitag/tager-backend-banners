<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByIdJob;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Banners\Resources\BannerResource;
use OZiTAG\Tager\Backend\Blog\Resources\Admin\AdminPostResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class ListBannerItemsFeature extends Feature
{
    private $areaId;

    public function __construct($areaId)
    {
        $this->areaId = $areaId;
    }

    public function handle(BannersRepository $repository)
    {
        $bannerArea = $this->run(GetBannerAreaByIdJob::class, ['id' => $this->areaId]);

        $bannersCollection = $repository->findByBannerArea($bannerArea->id);

        return BannerResource::collection($bannersCollection);
    }
}
