<?php

namespace OZiTAG\Tager\Backend\Banners\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'areaAlias' => $this->area ? $this->area->alias : null,
            'title' => $this->title,
            'text' => $this->text,
            'image' => $this->image ? $this->image->getUrl() : null,
            'buttonLabel' => $this->button_label,
            'buttonLink' => $this->button_link,
            'buttonIsNewTab' => (boolean)$this->button_is_new_tab
        ];
    }
}
