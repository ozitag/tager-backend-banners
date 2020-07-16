<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Blog\Repositories\CategoryRepository;

class GetPriorityForNewBannerJob
{
    private $areaId;

    public function __construct($areaId)
    {
        $this->areaId = $areaId;
    }

    public function handle(BannersRepository $repository)
    {
        $model = $repository->findItemWithMaxPriority($this->areaId);

        return $model ? $model->priority + 1 : 1;
    }
}
