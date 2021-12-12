<?php

namespace OZiTAG\Tager\Backend\Banners\Enums;

enum TagerBannersStatus: int
{
    case Active = 0;
    case Waiting = 1;
    case Archived = 2;

    public static function getPublicValue(self $value): ?string
    {
        switch ($value) {
            case self::Active:
                return 'ACTIVE';
            case self::Waiting:
                return 'WAITING';
            case self::Archived:
                return 'ARCHIVED';
            default:
                return null;
        }
    }

    public static function fromPublicValue(string $publicValue): ?self
    {
        switch ($publicValue) {
            case 'ACTIVE':
                return self::from(self::Active->value);
            case 'WAITING':
                return self::from(self::Waiting->value);
            case 'ARCHIVED':
                return self::from(self::Archived->value);
            default:
                return null;
        }
    }
}
