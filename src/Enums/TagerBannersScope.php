<?php

namespace OZiTAG\Tager\Backend\Banners\Enums;

enum TagerBannersScope: string
{
    case View = 'tager-banners.view';
    case Create = 'tager-banners.create';
    case Edit = 'tager-banners.edit';
    case Delete = 'tager-banners.delete';
}
