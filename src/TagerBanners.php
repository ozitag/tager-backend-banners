<?php

namespace OZiTAG\Tager\Backend\Banners;

use OZiTAG\Tager\Backend\Fields\Base\Field;

class TagerBanners
{
    private static array $bannerZones = [];

    public static function registerBannerZone(string $systemName, string $name, ?string $fileScenario, ?array $additionalFields = [])
    {
        if (isset(self::$bannerZones[$systemName])) {
            throw new \Exception('Banner Zone with name "' . $systemName . '" already exists');
        }

        self::$bannerZones[$systemName] = [
            'systemName' => $systemName,
            'name' => $name,
            'fileScenario' => $fileScenario,
            'additionalFields' => $additionalFields
        ];
    }

    /**
     * @return Field[]
     */
    public static function getBannerZoneFields(string $zone): array
    {
        $bannerZone = self::getBannerZone($zone);
        if (!$bannerZone) {
            return [];
        }

        $fields = [];
        foreach ($bannerZone['additionalFields'] as $name => $additionalField) {
            $fields[] = $additionalField->setName($name);
        }

        return $fields;
    }

    public static function getBannerZoneIds(): array
    {
        return array_keys(self::$bannerZones);
    }

    public static function getBannerZones(): array
    {
        return self::$bannerZones;
    }

    public static function isBannerZoneExists(string $zoneName): ?bool
    {
        return isset(self::$bannerZones[$zoneName]);
    }

    public static function getBannerZone(string $zoneName): ?array
    {
        return self::$bannerZones[$zoneName] ?? null;
    }
}
