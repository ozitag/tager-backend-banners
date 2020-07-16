<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use OZiTAG\Tager\Backend\Banners\Jobs\CreateBannerJob;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByIdJob;
use OZiTAG\Tager\Backend\Banners\Jobs\GetPriorityForNewBannerJob;
use OZiTAG\Tager\Backend\Banners\Requests\BannerRequest;
use OZiTAG\Tager\Backend\Banners\Resources\BannerResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Menus\Jobs\CreateMenuJob;

class CreateBannerItemFeature extends Feature
{
    private $areaId;

    public function __construct($areaId)
    {
        $this->areaId = $areaId;
    }

    public function handle(BannerRequest $request)
    {
        $area = $this->run(GetBannerAreaByIdJob::class, ['id' => $this->areaId]);

        $priority = $this->run(GetPriorityForNewBannerJob::class, ['areaId' => $this->areaId]);

        $model = $this->run(CreateBannerJob::class, [
            'area' => $area,
            'title' => $request->title,
            'text' => $request->text,
            'buttonLink' => $request->buttonLink,
            'buttonLabel' => $request->buttonLabel,
            'buttonIsNewTab' => $request->buttonIsNewTab,
            'image' => $request->image,
            'priority' => $priority,
        ]);

        return new BannerResource($model);
    }
}
