<?php

namespace OZiTAG\Tager\Backend\Banners\Console;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Jobs\UpdateBannerStatusJob;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Core\Console\Command;

class TagerBannersUpdateStatusesCommand extends Command
{
    public $signature = 'cron:tager-banners:update-statuses';

    public function handle()
    {
        /** @var BannersRepository $repository */
        $repository = App::make(BannersRepository::class);

        /** @var TagerBanner[] $banners */
        $banners = $repository->queryForStatus(TagerBannersStatus::Waiting)->get();

        $this->log('Found ' . count($banners) . ' waiting banners');

        foreach ($banners as $ind => $banner) {
            $this->log('Banner ' . ($ind + 1) . '/' . count($banners) . ': ', false);

            /** @var TagerBanner $banner */
            $banner = $this->runJob(UpdateBannerStatusJob::class, [
                'model' => $banner
            ]);
        }

        /** @var TagerBanner[] $banners */
        $banners = $repository->queryForStatus(TagerBannersStatus::Active)->get();

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
