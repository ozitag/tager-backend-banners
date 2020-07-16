<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerByIdJob;
use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Banners\Resources\BannerResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class ViewBannerItemFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(BannerRequest $request)
    {
        $model = $this->run(GetBannerByIdJob::class, ['id' => $this->id]);

        return new BannerResource($model);
    }
}
