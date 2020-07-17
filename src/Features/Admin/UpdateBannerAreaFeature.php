<?php

namespace OZiTAG\Tager\Backend\Banners\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Banners\Jobs\GetBannerAreaByIdJob;
use OZiTAG\Tager\Backend\Banners\Jobs\UpdateBannerAreaJob;
use OZiTAG\Tager\Backend\Banners\Requests\BannerAreaRequest;
use OZiTAG\Tager\Backend\Banners\Resources\BannerAreaResource;

class UpdateBannerAreaFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(BannerAreaRequest $request)
    {
        $model = $this->run(GetBannerAreaByIdJob::class, ['id' => $this->id]);

        $model = $this->run(UpdateBannerAreaJob::class, [
            'model' => $model,
            'alias' => $request->alias,
            'label' => $request->label,
            'scenario' => $request->scenario,
        ]);

        return new BannerAreaResource($model);
    }
}
