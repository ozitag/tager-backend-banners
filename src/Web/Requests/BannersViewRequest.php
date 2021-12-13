<?php

namespace OZiTAG\Tager\Backend\Banners\Web\Requests;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

/**
 * @property int $limit
 * @property int $random
 */
class BannersViewRequest extends FormRequest
{
    public function rules()
    {
        return [
            'limit' => ['nullable', 'integer'],
            'random' => ['nullable', 'boolean']
        ];
    }
}
