<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\QueueJob;
use OZiTAG\Tager\Backend\Mail\Enums\TagerMailStatus;
use OZiTAG\Tager\Backend\Mail\Exceptions\TagerMailSenderException;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailLog;
use App\Models\Product;
use App\Repositories\Interfaces\IProductReviewRepository;
use OZiTAG\Tager\Backend\Mail\Repositories\MailLogRepository;
use OZiTAG\Tager\Backend\Mail\Senders\SenderFactory;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailAttachments;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailConfig;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailSender;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;

class GetBannerAreaByAliasJob
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = TagerBannerArea::query()->where('alias', '=', $this->alias)->first();

        if (!$model) {
            abort(404, 'Banner Area not found');
        }

        return $model;
    }
}
