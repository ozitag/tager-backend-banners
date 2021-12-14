<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\BannerZones\Features;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Banners\TagerBanners;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class BannerZonesIndexFeature extends Feature
{
    public function handle(BannersRepository $bannersRepository)
    {
        $bannerZones = TagerBanners::getBannerZones();

        $response = [];
        foreach ($bannerZones as $bannerZone) {
            $response[] = [
                'id' => $bannerZone['systemName'],
                'name' => $bannerZone['name'],
                'bannersCount' => $bannersRepository->queryForZone($bannerZone['systemName'])->count(),
            ];
        }

        return new JsonResource($response);
    }
}
