<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\Banners;

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
            'id', 'status', 'banner_zone',
            'image' => 'image:file:url',
            'link',
            'open_new_tab:bool', 'disabled:bool',
            'comment'
        ]);

        $this->setFullResourceFields([
            'id', 'status', 'banner_zone',
            'image' => 'image:file:model',
            'link',
            'open_new_tab:bool', 'disabled:bool',
            'comment'
        ]);

        $this->setStoreAndUpdateAction(new StoreOrUpdateAction(
            BannerRequest::class,
            BannerCreateOrUpdateOperation::class
        ));

        $this->setCacheNamespace('tager/banners');
    }
}