<?php

namespace OZiTAG\Tager\Backend\Banners\Controllers;

use OZiTAG\Tager\Backend\Banners\Features\Admin\CreateBannerItemFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\ListBannerItemsFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\MoveBannerItemFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\RemoveBannerItemFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\UpdateBannerItemFeature;
use OZiTAG\Tager\Backend\Core\Controller;
use OZiTAG\Tager\Backend\Banners\Features\Admin\ViewBannerAreaByAliasFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\ViewBannerAreaFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\CreateBannerAreaFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\ListBannerAreaFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\RemoveBannerAreaFeature;
use OZiTAG\Tager\Backend\Banners\Features\Admin\UpdateBannerAreaFeature;

class AdminController extends Controller
{
    public function index()
    {
        return $this->serve(ListBannerAreaFeature::class);
    }

    public function create()
    {
        return $this->serve(CreateBannerAreaFeature::class);
    }

    public function view($id)
    {
        return $this->serve(ViewBannerAreaFeature::class, [
            'id' => $id
        ]);
    }

    public function viewByAlias($alias)
    {
        return $this->serve(ViewBannerAreaByAliasFeature::class, [
            'alias' => $alias
        ]);
    }

    public function update($id)
    {
        return $this->serve(UpdateBannerAreaFeature::class, [
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        return $this->serve(RemoveBannerAreaFeature::class, [
            'id' => $id
        ]);
    }

    public function listItems($id)
    {
        return $this->serve(ListBannerItemsFeature::class, [
            'areaId' => $id
        ]);
    }

    public function createItem($id)
    {
        return $this->serve(CreateBannerItemFeature::class, [
            'areaId' => $id
        ]);
    }

    public function updateItem($id)
    {
        return $this->serve(UpdateBannerItemFeature::class, [
            'id' => $id
        ]);
    }

    public function removeItem($id)
    {
        return $this->serve(RemoveBannerItemFeature::class, [
            'id' => $id
        ]);
    }

    public function moveItem($id, $direction)
    {
        return $this->serve(MoveBannerItemFeature::class, [
            'id' => $id,
            'direction' => $direction,
        ]);
    }
}
