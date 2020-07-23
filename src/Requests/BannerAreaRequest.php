<?php

namespace OZiTAG\Tager\Backend\Banners\Requests;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class BannerAreaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'label' => 'required|string',
            'scenario' => 'nullable|string',
            'alias' => ['string', 'required', 'unique:tager_banner_areas,alias,' . $this->route('id')]
        ];
    }
}
