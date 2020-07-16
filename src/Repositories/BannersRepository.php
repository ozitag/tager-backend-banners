<?php

namespace OZiTAG\Tager\Backend\Banners\Repositories;

use OZiTAG\Tager\Backend\Blog\Models\BlogCategory;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;

class BannersRepository extends EloquentRepository
{
    public function __construct(TagerBanner $model)
    {
        parent::__construct($model);
    }

    /**
     * @return TagerBanner|null
     */
    public function findItemWithMaxPriority($areaId)
    {
        return TagerBanner::query()->where('banner_area_id', '=', $areaId)
            ->orderBy('priority', 'desc')->first();
    }

    public function findByBannerArea($areaId)
    {
        return TagerBanner::query()->where('banner_area_id', '=', $areaId)->get();
    }

    public function findFirstWithLowerPriorityThan($areaId, $priority)
    {
        return TagerBanner::where('priority', '<', $priority)->where('banner_area_id', '=', $areaId)->orderBy('priority', 'desc')->first();
    }

    public function findFirstWithHigherPriorityThan($areaId, $priority)
    {
        return TagerBanner::where('priority', '>', $priority)->where('banner_area_id', '=', $areaId)->orderBy('priority', 'asc')->first();
    }
}
