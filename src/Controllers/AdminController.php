<?php

namespace OZiTAG\Tager\Backend\Banners\Controllers;

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
}
