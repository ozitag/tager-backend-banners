<?php

namespace OZiTAG\Tager\Backend\Banners\Models;

use Ozerich\FileStorage\Models\File;
use OZiTAG\Tager\Backend\Core\Models\TModel;
use OZiTAG\Tager\Backend\Crud\Contracts\IModelPriorityConditional;

/**
 * @property string $banner_id
 * @property string $field
 * @property string $value
 */
class TagerBannerField extends TModel
{
    public $timestamps = false;

    protected $table = 'tager_banners_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_id', 'field', 'value'
    ];
}
