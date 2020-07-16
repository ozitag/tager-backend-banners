<?php

namespace OZiTAG\Tager\Backend\Banners\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'priority',
        'banner_area_id',
        'title',
        'text',
        'image_id',
        'button_label',
        'button_link',
        'button_is_new_tab',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('priority', 'asc');
        });
    }
}
