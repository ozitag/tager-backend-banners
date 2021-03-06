<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerByIdJob;
use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Banners\Resources\BannerFullResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;

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

        return new BannerFullResource($model);
    }
}
