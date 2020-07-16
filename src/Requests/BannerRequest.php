<?php

namespace OZiTAG\Tager\Backend\Banners\Requests;

use Ozerich\FileStorage\Rules\FileRule;
use OZiTAG\Tager\Backend\Core\FormRequest;

class BannerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'nullable|string',
            'text' => 'nullable|string',
            'image' => ['nullable', 'numeric', new FileRule()],
            'buttonLink' => 'nullable|string',
            'buttonLabel' => 'nullable|string',
            'buttonIsNewTab' => 'nullable|boolean',
        ];
    }
}
