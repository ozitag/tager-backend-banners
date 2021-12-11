<?php

namespace OZiTAG\Tager\Backend\Banners\Enums;

enum TagerBannersStatus
{
    const Active = '0';
    const Waiting = '1';
    const Archived = '2';

    public static function getPublicValue(string $value): ?string
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

    public static function fromPublicValue(string $publicValue): ?string
    {
        switch ($publicValue) {
            case 'ACTIVE':
                return self::Active;
            case 'WAITING':
                return self::Waiting;
            case 'ARCHIVED':
                return self::Archived;
            default:
                return null;
        }
    }
}
