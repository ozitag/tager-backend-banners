<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Guest;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Banners\Resources\BannerPublicResource;

;

use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByAliasJob;

class ViewBannerFeature extends Feature
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function handle(BannersRepository $repository)
    {
        $model = $this->run(GetBannerAreaByAliasJob::class, ['alias' => $this->alias]);

        $collection = $repository->findByBannerArea($model->id);

        return BannerPublicResource::collection($collection);
    }
}
