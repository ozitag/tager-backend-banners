<?php

namespace OZiTAG\Tager\Backend\Banners\Repositories;

use Illuminate\Database\Eloquent\Builder;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerField;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;

class BannersFieldsRepository extends EloquentRepository
{
    public function __construct(TagerBannerField $model)
    {
        parent::__construct($model);
    }

    public function queryForBanner(int $bannerId): Builder
    {
        return $this->builder()->where('banner_id', $bannerId);
    }
}
