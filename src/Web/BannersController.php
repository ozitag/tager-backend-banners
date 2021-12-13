<?php

namespace OZiTAG\Tager\Backend\Banners\Web;

use OZiTAG\Tager\Backend\Banners\Web\Features\BannersViewFeature;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;

class BannersController extends Controller
{
    public function view(string $zone)
    {
        return $this->serve(BannersViewFeature::class, [
            'zone' => $zone
        ]);
    }
}
