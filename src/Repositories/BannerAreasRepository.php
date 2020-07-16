<?php

namespace OZiTAG\Tager\Backend\Banners\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailTemplate;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;

class BannerAreasRepository extends EloquentRepository
{
    public function __construct(TagerBannerArea $model)
    {
        parent::__construct($model);
    }

    public function findByAlias($alias)
    {
        return TagerBannerArea::whereAlias($alias)->first();
    }
}
