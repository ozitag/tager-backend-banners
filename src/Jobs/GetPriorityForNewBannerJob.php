<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;

class GetPriorityForNewBannerJob extends Job
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
