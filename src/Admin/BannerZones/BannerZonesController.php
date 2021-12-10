<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\BannerZones;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;

class BannerZonesController extends Controller
{
    public function index()
    {
        return $this->serve(BannerZonesIndexFeature::class);
    }
}