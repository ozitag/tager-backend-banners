<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\Banners;

use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Crud\Actions\IndexAction;
use OZiTAG\Tager\Backend\Crud\Actions\StoreOrUpdateAction;
use OZiTAG\Tager\Backend\Crud\Controllers\AdminCrudController;

class BannersController extends AdminCrudController
{
    public bool $hasCountAction = true;

    public function __construct(BannersRepository $bannersRepository)
    {
        parent::__construct($bannersRepository);

        $this->setIndexAction((new IndexAction())->enablePagination());

        $this->setResourceFields([
            'id',
            'bannerZone' => 'banner_zone',
            'status' => function (TagerBanner $banner) {
                if ($banner->disabled) {
                    return 'DISABLED';
                } else {
                    return TagerBannersStatus::getPublicValue(TagerBannersStatus::from($banner->status));
                }
            },
            'image' => 'image:file:url',
            'link', 'openNewTab' => 'open_new_tab:bool',
            'dateStart' => 'start_at:date',
            'dateEnd' => 'finish_at:date',
            'comment'
        ]);

        $this->setFullResourceFields([
            'id', 'status' => function (TagerBanner $banner) {
                return TagerBannersStatus::getPublicValue(TagerBannersStatus::from($banner->status));
            }, 'bannerZone' => 'banner_zone',
            'image' => 'image:file:model',
            'link', 'openNewTab' => 'open_new_tab:bool',
            'disabled:bool',
            'dateStart' => 'start_at:date',
            'dateEnd' => 'finish_at:date',
            'comment'
        ]);

        $this->setStoreAndUpdateAction(new StoreOrUpdateAction(
            BannerRequest::class,
            BannerCreateOrUpdateOperation::class
        ));

        $this->setCacheNamespace('tager/banners');
    }
}
