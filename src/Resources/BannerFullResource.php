<?php

namespace OZiTAG\Tager\Backend\Banners\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Ozerich\FileStorage\Models\File;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailTemplate;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailConfig;
use OZiTAG\Tager\Backend\Seo\Models\SeoPage;

class BannerFullResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'image' => $this->image ? $this->image->getShortJson() : null,
            'buttonLabel' => $this->button_label,
            'buttonLink' => $this->button_link,
            'buttonIsNewTab' => (boolean)$this->button_is_new_tab
        ];
    }
}
