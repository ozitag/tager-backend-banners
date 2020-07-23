<?php

namespace OZiTAG\Tager\Backend\Banners\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ozerich\FileStorage\Models\File;

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

    public function area()
    {
        return $this->belongsTo(TagerBannerArea::class, 'banner_area_id');
    }

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('priority', 'asc');
        });
    }
}
