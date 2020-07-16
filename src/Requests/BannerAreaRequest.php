<?php

namespace OZiTAG\Tager\Backend\Banners\Requests;

use Ozerich\FileStorage\Rules\FileRule;
use OZiTAG\Tager\Backend\Core\FormRequest;

class BannerAreaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'label' => 'required|string',
            'alias' => ['string', 'required', 'unique:tager_banner_areas,alias,' . $this->route('id')]
        ];
    }
}
