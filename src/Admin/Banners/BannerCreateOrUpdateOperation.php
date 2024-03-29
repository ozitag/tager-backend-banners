<?php

namespace OZiTAG\Tager\Backend\Banners\Admin\Banners;

use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersStatus;
use OZiTAG\Tager\Backend\Banners\Jobs\UpdateBannerStatusJob;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Banners\TagerBanners;
use OZiTAG\Tager\Backend\Core\Jobs\Operation;

class BannerCreateOrUpdateOperation extends Operation
{
    protected ?TagerBanner $model;

    protected BannerRequest $request;

    public function __construct(BannerRequest $request, ?TagerBanner $model = null)
    {
        $this->model = $model;

        $this->request = $request;
    }

    public function handle(BannersRepository $bannersRepository, Storage $storage)
    {
        if ($this->model) {
            $bannersRepository->set($this->model);
        }

        if (!$this->request->priority) {
            $priority = 1;
        } else {
            $priority = $this->request->priority;
        }

        $bannerZone = TagerBanners::getBannerZone($this->request->bannerZone);
        if ($bannerZone) {
            $storage->setFileScenario($this->request->image, $bannerZone['fileScenario']);
        }

        $model = $bannersRepository->fillAndSave([
            'priority' => $priority,
            'banner_zone' => $this->request->bannerZone,
            'link' => $this->request->link,
            'image_id' => Storage::fromUUIDtoId($this->request->image),
            'open_new_tab' => $this->request->openNewTab,
            'start_at' => $this->request->dateStart,
            'finish_at' => $this->request->dateEnd,
            'disabled' => $this->request->disabled,
            'comment' => $this->request->comment,
            'status' => TagerBannersStatus::Waiting
        ]);

        $model = $this->run(ProcessBannerFieldsJob::class, [
            'model' => $model,
            'fields' => $this->request->fields
        ]);

        $model = $this->run(UpdateBannerStatusJob::class, [
            'model' => $model
        ]);

        return $model;
    }
}
