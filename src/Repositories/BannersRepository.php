<?php

namespace OZiTAG\Tager\Backend\Banners\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;

class BannersRepository extends EloquentRepository
{
    public function __construct(TagerBanner $model)
    {
        parent::__construct($model);
    }
}
