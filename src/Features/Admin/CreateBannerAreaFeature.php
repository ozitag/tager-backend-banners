<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Banners\Jobs\CreateBannerAreaJob;
use OZiTAG\Tager\Backend\Banners\Requests\BannerAreaRequest;
use OZiTAG\Tager\Backend\Banners\Resources\BannerAreaResource;

class CreateBannerAreaFeature extends Feature
{
    public function handle(BannerAreaRequest $request)
    {
        $model = $this->run(CreateBannerAreaJob::class, [
            'alias' => $request->alias,
            'label' => $request->label,
        ]);

        return new BannerAreaResource($model);
    }
}
