<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Jobs\CreateBannerJob;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerByIdJob;
use OZiTAG\Tager\Backend\Banners\Jobs\UpdateBannerJob;
use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Banners\Resources\BannerResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class UpdateBannerItemFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(BannerRequest $request)
    {
        $model = $this->run(GetBannerByIdJob::class, [
            'id' => $this->id
        ]);

        $model = $this->run(UpdateBannerJob::class, [
            'model' => $model,
            'title' => $request->title,
            'text' => $request->text,
            'buttonLink' => $request->buttonLink,
            'buttonLabel' => $request->buttonLabel,
            'buttonIsNewTab' => $request->buttonIsNewTab,
            'image' => $request->image
        ]);

        return new BannerResource($model);
    }
}
