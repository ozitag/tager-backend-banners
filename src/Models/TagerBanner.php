<?php

namespace OZiTAG\Tager\Backend\Banners\Models;

use Ozerich\FileStorage\Models\File;
use OZiTAG\Tager\Backend\Core\Models\TModel;
use OZiTAG\Tager\Backend\Crud\Contracts\IModelPriorityConditional;

/**
 * @property string $banner_zone
 * @property integer $priority
 * @property integer $image_id
 * @property string $link
 * @property boolean $open_new_tab
 * @property integer $status
 * @property boolean $disabled
 * @property string $start_at
 * @property string $finish_at
 * @property string $comment
 *
 * @property File $image
 */
class TagerBanner extends TModel implements IModelPriorityConditional
{
    public $timestamps = false;

    protected $table = 'tager_banners';

    static $defaultOrder = 'status ASC, priority ASC';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_zone', 'priority', 'image_id', 'link', 'open_new_tab', 'status', 'disabled',
        'start_at', 'finish_at', 'comment'
    ];

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function getPriorityConditionalAttributes()
    {
        return [
            'banner_zone'
        ];
    }
}
