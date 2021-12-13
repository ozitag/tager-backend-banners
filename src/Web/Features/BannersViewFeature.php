<?php

namespace OZiTAG\Tager\Backend\Banners\Web\Features;

use Http\Client\Common\Exception\ServerErrorException;
use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Auth\Http\Resources\AuthLogResource;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Banners\TagerBanners;
use OZiTAG\Tager\Backend\Banners\Web\Requests\BannersViewRequest;
use OZiTAG\Tager\Backend\Banners\Web\Resources\BannerResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\ResourceCollection;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\Crud\Resources\ModelResource;

class BannersViewFeature extends Feature
{
    protected string $zone;

    public function __construct(string $zone)
    {
        $this->zone = $zone;
    }

    public function handle(BannersViewRequest $request, BannersRepository $bannersRepository)
    {
        if (TagerBanners::isBannerZoneExists($this->zone) == false) {
            throw new ServerErrorException('Zone not found');
        }

        $limit = intval($request->limit) ?? 11111;

        $query = $bannersRepository->builder()->where('status', TagerBannersStatus::Active)->where('disabled', false);
        if ($limit) {
            $query->limit($limit);
        };

        $items = $query->get();

        if ($request->random) {
            $items = $items->shuffle();
        }

        $items->transform(function ($item) {
            return new BannerResource($item);
        });

        return new JsonResource($items);
    }
}
