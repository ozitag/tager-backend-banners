<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\Banners;

use Ozerich\FileStorage\Rules\FileRule;
use OZiTAG\Tager\Backend\Banners\TagerBanners;
use OZiTAG\Tager\Backend\Crud\Requests\CrudFormRequest;
use OZiTAG\Tager\Backend\Validation\Rule;

/**
 * @property string $bannerZone
 * @property string $image
 * @property string $link
 * @property bool $openNewTab
 * @property boolean $disabled
 * @property string $dateStart
 * @property string $dateEnd
 * @property string $comment
 * @property int $priority
 * @property array $fields
 */
class BannerRequest extends CrudFormRequest
{
    public function rules()
    {
        return [
            'bannerZone' => ['required', 'string', Rule::in(TagerBanners::getBannerZoneIds())],
            'image' => ['required', new FileRule()],
            'link' => ['required', 'string'],
            'openNewTab' => ['required', 'boolean'],
            'disabled' => ['required', 'boolean'],
            'dateStart' => ['nullable', 'date'],
            'dateEnd' => ['nullable', 'date'],
            'comment' => ['nullable', 'string'],
            'priority' => ['nullable', 'integer'],
            'fields' => ['nullable', 'array'],
            'fields.*.name' => ['required', 'string'],
            'fields.*.value' => ['present', 'nullable'],
        ];
    }
}
