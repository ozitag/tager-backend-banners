<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\Banners;

use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Jobs\UpdateBannerStatusJob;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersFieldsRepository;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Banners\TagerBanners;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Jobs\Operation;

class ProcessBannerFieldsJob extends Job
{
    protected TagerBanner $model;

    protected array $fields;

    public function __construct(TagerBanner $model, ?array $fields = null)
    {
        $this->model = $model;

        $this->fields = $fields ?: [];
    }

    public function handle(BannersFieldsRepository $bannersFieldsRepository)
    {
        $bannersFieldsRepository->queryForBanner($this->model->id)->delete();
        $bannerZoneFields = TagerBanners::getBannerZoneFields($this->model->banner_zone);

        foreach ($bannerZoneFields as $field) {
            $value = null;
            foreach ($this->fields as $fieldValue) {
                if ($fieldValue['name'] == $field->getName()) {
                    $value = $fieldValue['value'];
                    break;
                }
            }

            if ($value) {
                $type = $field->getTypeInstance();
                $type->setValue($value);
                $dbValue = $type->getDatabaseValue();
            } else {
                $dbValue = null;
            }

            $bannersFieldsRepository->create([
                'banner_id' => $this->model->id,
                'field' => $field->getName(),
                'value' => $dbValue
            ]);
        }

        return $this->model;
    }
}
