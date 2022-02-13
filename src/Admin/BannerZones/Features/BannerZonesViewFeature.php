<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\BannerZones\Features;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Banners\TagerBanners;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class BannerZonesViewFeature extends Feature
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function handle(BannersRepository $bannersRepository)
    {
        if (TagerBanners::isBannerZoneExists($this->name) == false) {
            throw new NotFoundHttpException('Баннерная зона не найдена');
        }

        $bannerZone = TagerBanners::getBannerZone($this->name);
        $fields = TagerBanners::getBannerZoneFields($bannerZone['systemName']);

        $fieldsValue = [];
        foreach ($fields as $field) {
            $fieldsValue[] = $field->getJson();
        }

        return new JsonResource([
            'id' => $bannerZone['systemName'],
            'name' => $bannerZone['name'],
            'scenario' => $bannerZone['fileScenario'],
            'bannersCount' => $bannersRepository->queryForZone($bannerZone['systemName'])->count(),
            'fields' =>$fieldsValue
        ]);
    }
}
