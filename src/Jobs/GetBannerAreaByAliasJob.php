<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;

class GetBannerAreaByAliasJob extends Job
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = TagerBannerArea::query()->where('alias', '=', $this->alias)->first();

        if (!$model) {
            abort(404, 'Banner Area not found');
        }

        return $model;
    }
}
