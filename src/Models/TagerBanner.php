<?php

namespace OZiTAG\Tager\Backend\Banners\Models;

use Ozerich\FileStorage\Models\File;
use OZiTAG\Tager\Backend\Banners\TagerBanners;
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
 * @property TagerBannerField[] $fields
 */
class TagerBanner extends TModel implements IModelPriorityConditional
{
    public $timestamps = false;

    protected $table = 'tager_banners';

    static string $defaultOrder = 'status ASC, priority DESC';

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

    public function fields()
    {
        return $this->hasMany(TagerBannerField::class, 'banner_id');
    }

    public function getPriorityConditionalAttributes()
    {
        return [
            'banner_zone'
        ];
    }

    public function getFieldsAdminJson()
    {
        $fields = TagerBanners::getBannerZoneFields($this->banner_zone);
        if (empty($fields)) {
            return [];
        }

        $result = [];
        foreach ($fields as $field) {
            $dbValue = null;
            foreach ($this->fields as $dbField) {
                if ($dbField->field == $field->getName()) {
                    $dbValue = $dbField->value;
                    break;
                }
            }

            if($dbValue) {
                $type = $field->getTypeInstance();
                $type->loadValueFromDatabase($dbValue);
                $jsonValue = $type->getAdminFullJson();
            } else{
                $jsonValue = null;
            }

            $result[] = [
                'name' => $field->getName(),
                'value' => $jsonValue
            ];
        }

        return $result;
    }

    public function getFieldsPublicJson()
    {
        $fields = TagerBanners::getBannerZoneFields($this->banner_zone);
        if (empty($fields)) {
            return [];
        }

        $result = [];
        foreach ($fields as $field) {
            $dbValue = null;
            foreach ($this->fields as $dbField) {
                if ($dbField->field == $field->getName()) {
                    $dbValue = $dbField->value;
                    break;
                }
            }

            if($dbValue) {
                $type = $field->getTypeInstance();
                $type->loadValueFromDatabase($dbValue);
                $jsonValue = $type->getPublicValue();
            } else{
                $jsonValue = null;
            }

            $result[] = [
                'name' => $field->getName(),
                'value' => $jsonValue
            ];
        }

        return $result;
    }
}
