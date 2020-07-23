<?php

namespace OZiTAG\Tager\Backend\Banners\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerAreaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'alias' => $this->alias,
            'label' => $this->label,
            'scenario' => $this->scenario ? $this->scenario : null
        ];
    }
}
