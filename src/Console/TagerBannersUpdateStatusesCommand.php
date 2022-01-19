<?php

namespace OZiTAG\Tager\Backend\Banners\Console;

use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Jobs\UpdateBannerStatusJob;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Cron\Console\CronCommand;

class TagerBannersUpdateStatusesCommand extends CronCommand
{
    public $signature = 'cron:tager-banners:update-statuses';

    protected BannersRepository $bannersRepository;

    public function __construct(BannersRepository $bannersRepository)
    {
        $this->bannersRepository = $bannersRepository;
        parent::__construct();
    }

    public function handle()
    {
        /** @var TagerBanner[] $banners */
        $banners = $this->bannersRepository->queryForStatus(TagerBannersStatus::Waiting)->get();

        $this->log('Found ' . count($banners) . ' waiting banners');

        foreach ($banners as $ind => $banner) {
            $this->log('Banner ' . ($ind + 1) . '/' . count($banners) . ': ', false);

            /** @var TagerBanner $banner */
            $banner = $this->runJob(UpdateBannerStatusJob::class, [
                'model' => $banner
            ]);

            $this->log(TagerBannersStatus::getPublicValue(TagerBannersStatus::from($banner->status)));
        }

        /** @var TagerBanner[] $banners */
        $banners = $this->bannersRepository->queryForStatus(TagerBannersStatus::Active)->get();

        $this->log('Found ' . count($banners) . ' active banners');

        foreach ($banners as $ind => $banner) {
            $this->log('Banner ' . ($ind + 1) . '/' . count($banners) . ': ', false);

            /** @var TagerBanner $banner */
            $banner = $this->runJob(UpdateBannerStatusJob::class, [
                'model' => $banner
            ]);

            $this->log(TagerBannersStatus::getPublicValue(TagerBannersStatus::from($banner->status)));
        }
    }
}
