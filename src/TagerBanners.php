<?php

namespace OZiTAG\Tager\Backend\Banners;

class TagerBanners
{
    private static array $bannerZones = [];

    public static function registerBannerZone(string $systemName, string $name, ?string $fileScenario)
    {
        if (isset(self::$bannerZones[$systemName])) {
            throw new \Exception('Banner Zone with name "' . $systemName . '" already exists');
        }

        self::$bannerZones[$systemName] = [
            'systemName' => $systemName,
            'name' => $name,
            'fileScenario' => $fileScenario
        ];
    }

    public static function getBannerZoneIds(): array
    {
        return array_keys(self::$bannerZones);
    }

    public static function getBannerZones(): array
    {
        return self::$bannerZones;
    }
}