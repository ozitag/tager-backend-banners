<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;

class GetBannerByIdJob extends Job
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(BannersRepository $repository)
    {
        $model = $repository->find($this->id);
        if (!$model) {
            abort(404, 'Banner  not found');
        }
        return $model;
    }
}
