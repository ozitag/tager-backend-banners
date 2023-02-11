<?php

namespace OZiTAG\Tager\Backend\Banners\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Core\Repositories\IFilterable;
use OZiTAG\Tager\Backend\Core\Repositories\ISearchable;
use OZiTAG\Tager\Backend\Crud\Contracts\IRepositoryWithPriorityMethods;
use OZiTAG\Tager\Backend\Crud\Traits\RepositoryPriorityMethodsTrait;

class BannersRepository extends EloquentRepository implements IRepositoryWithPriorityMethods, IFilterable, ISearchable
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

    public function queryForStatus(TagerBannersStatus $status): Builder
    {
        return $this->builder()->where('status', '=', $status);
    }

    public function searchByQuery(?string $query, Builder $builder = null): ?Builder
    {
        $builder = $builder ? $builder : $this->model;

        return $builder->where(function ($builder) use ($query) {
            $builder->where('comment', 'LIKE', "%$query%");
        });
    }

    public function filterByKey(Builder $builder, string $key, mixed $value): Builder
    {
        switch ($key) {
            case 'zone':
                return $builder->whereIn('banner_zone', explode(',', $value));
            case 'status':
                return $builder->where(function ($builder) use ($value) {
                    $valueArray = explode(',', $value);

                    $builder->where('disabled', in_array('DISABLED', $valueArray));

                    $valueArrayStatuses = [];
                    foreach ($valueArray as $valueArrayItem) {
                        $value = TagerBannersStatus::fromPublicValue($valueArrayItem);
                        if (!is_null($value)) {
                            $valueArrayStatuses[] = $value;
                        }
                    }

                    return $builder->WhereIn('status', $valueArrayStatuses);
                });
            case 'date':
                return $builder->where(function ($builder) use ($value) {
                    $builder->whereNull('start_at')->orWhere('start_at', '<=', $value);
                })->where(function ($builder) use ($value) {
                    $builder->whereNull('finish_at')->orWhere('finish_at', '>=', $value);
                });
            default:
                return $builder;
        }
    }
}
