<?php

namespace OZiTAG\Tager\Backend\Banners\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class TagerBanner extends Model
{
    public $timestamps = false;

    protected $table = 'tager_banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_area_id',
        'title',
        'text',
        'image_id',
        'button_label',
        'button_link',
        'button_is_new_tab',
    ];
}
