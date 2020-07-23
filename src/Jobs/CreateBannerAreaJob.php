<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;

class CreateBannerAreaJob extends Job
{
    private $alias;

    private $label;

    private $scenario;

    public function __construct($alias, $label, $scenario)
    {
        $this->alias = $alias;
        $this->label = $label;
        $this->scenario = $scenario;
    }

    public function handle(BannerAreasRepository $repository)
    {
        return $repository->create([
            'alias' => $this->alias,
            'label' => $this->label,
            'scenario' => $this->scenario
        ]);
    }
}
