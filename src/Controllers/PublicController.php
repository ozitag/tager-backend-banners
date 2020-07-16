<?php

namespace OZiTAG\Tager\Backend\Banners\Controllers;

use OZiTAG\Tager\Backend\Core\Controller;
use OZiTAG\Tager\Backend\Banners\Features\Guest\ViewBannerFeature;

class PublicController extends Controller
{
    public function menu($alias)
    {
        return $this->serve(ViewBannerFeature::class, [
            'alias' => $alias
        ]);
    }
}
