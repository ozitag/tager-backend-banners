<?php

namespace OZiTAG\Tager\Backend\Banners\Repositories;

use Illuminate\Database\Eloquent\Builder;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerField;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Core\Repositories\IFilterable;
use OZiTAG\Tager\Backend\Core\Repositories\ISearchable;
use OZiTAG\Tager\Backend\Crud\Contracts\IRepositoryWithPriorityMethods;
use OZiTAG\Tager\Backend\Crud\Traits\RepositoryPriorityMethodsTrait;
use function Symfony\Component\String\b;

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
