<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Guest;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByAliasJob;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByIdJob;
use OZiTAG\Tager\Backend\Banners\Jobs\GetMenuItemsTreeJob;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class ViewBannerFeature extends Feature
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = $this->run(GetBannerAreaByAliasJob::class, ['alias' => $this->alias]);

        return new SuccessResource();
    }
}
