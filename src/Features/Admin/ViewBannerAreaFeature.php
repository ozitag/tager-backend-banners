<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByIdJob;
use OZiTAG\Tager\Backend\Banners\Resources\BannerAreaResource;

class ViewBannerAreaFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $model = $this->run(GetBannerAreaByIdJob::class, ['id' => $this->id]);

        return new BannerAreaResource($model);
    }
}
