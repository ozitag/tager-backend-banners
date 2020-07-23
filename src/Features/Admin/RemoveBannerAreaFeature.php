<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByIdJob;
use OZiTAG\Tager\Backend\Banners\Jobs\RemoveBannerAreaJob;

class RemoveBannerAreaFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $model = $this->run(GetBannerAreaByIdJob::class, ['id' => $this->id]);

        $this->run(RemoveBannerAreaJob::class, ['model' => $model]);

        return new SuccessResource();
    }
}
