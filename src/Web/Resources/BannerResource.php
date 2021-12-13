<?php

namespace OZiTAG\Tager\Backend\Banners\Web\Resources;

use OZiTAG\Tager\Backend\Administrators\Resources\AdminRoleResource;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Core\Resources\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getData()
    {
        /** @var TagerBanner $model */
        $model = $this->resource;

        return [
            'link' => $model->link,
            'openNewTab' => $model->open_new_tab,
            'image' => $model->image ? $model->image->getFullJson() : null
        ];
    }
}
