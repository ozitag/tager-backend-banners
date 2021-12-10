<?php

namespace OZiTAG\Tager\Backend\Banners\Repositories;

use Illuminate\Database\Eloquent\Builder;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Core\Repositories\IFilterable;
use OZiTAG\Tager\Backend\Crud\Contracts\IRepositoryWithPriorityMethods;
use OZiTAG\Tager\Backend\Crud\Traits\RepositoryPriorityMethodsTrait;

class BannersRepository extends EloquentRepository implements IRepositoryWithPriorityMethods, IFilterable
{
    use RepositoryPriorityMethodsTrait;

    public function __construct(TagerBanner $model)
    {
        parent::__construct($model);
    }

    public function queryForZone(string $zoneName): Builder
    {
        return $this->builder()->where('banner_zone', '=', $zoneName);
    }

    public function filterByKey(Builder $builder, string $key, mixed $value): Builder
    {
        switch ($key) {
            case 'zone':
                return $builder->whereIn('banner_zone', explode(',', $value));
            case 'status':
                return $builder->whereIn('status', explode(',', $value));
            default:
                return $builder;
        }
    }
}
