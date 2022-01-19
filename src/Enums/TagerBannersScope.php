<?php

namespace OZiTAG\Tager\Backend\Banners\Enums;

enum TagerBannersScope: string
{
    const View = 'tager-banners.view';
    const Create = 'tager-banners.create';
    const Edit = 'tager-banners.edit';
    const Delete = 'tager-banners.delete';
}
