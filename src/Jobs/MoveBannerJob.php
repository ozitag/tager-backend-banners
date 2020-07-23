<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;

class MoveBannerJob extends Job
{
    private $model;

    private $direction;

    public function __construct($model, $direction)
    {
        $this->model = $model;
        $this->direction = $direction;
    }

    public function handle(BannersRepository $repository)
    {
        if ($this->direction == 'up') {
            $other = $repository->findFirstWithLowerPriorityThan($this->model->banner_area_id, $this->model->priority);
        } else {
            $other = $repository->findFirstWithHigherPriorityThan($this->model->banner_area_id, $this->model->priority);
        }

        if (!$other) {
            return;
        }

        $a = $other->priority;
        $other->priority = $this->model->priority;
        $this->model->priority = $a;

        $this->model->save();
        $other->save();

        return $this->model;
    }
}
