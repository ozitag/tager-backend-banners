<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use App\Models\Product;
use App\Repositories\Interfaces\IProductReviewRepository;

class GetBannerByIdJob
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
