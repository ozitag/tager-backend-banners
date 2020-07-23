<?php

namespace OZiTAG\Tager\Backend\Banners\Controllers;

use OZiTAG\Tager\Backend\Banners\Features\Guest\ViewBannerFeature;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;

class PublicController extends Controller
{
    public function banner($alias)
    {
        return $this->serve(ViewBannerFeature::class, [
            'alias' => $alias
        ]);
    }
}
