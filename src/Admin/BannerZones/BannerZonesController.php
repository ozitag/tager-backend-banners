<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\BannerZones;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Banners\Admin\BannerZones\Features\BannerZonesViewFeature;
use OZiTAG\Tager\Backend\Banners\Admin\BannerZones\Features\BannerZonesIndexFeature;

class BannerZonesController extends Controller
{
    public function index()
    {
        return $this->serve(BannerZonesIndexFeature::class);
    }

    public function view(string $name)
    {
        return $this->serve(BannerZonesViewFeature::class, ['name' => $name]);
    }
}
