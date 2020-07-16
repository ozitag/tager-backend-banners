<?php

namespace OZiTAG\Tager\Backend\Banners\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagerBannerArea extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;

    protected $table = 'tager_banner_areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias',
        'label'
    ];
}
