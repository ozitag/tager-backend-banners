<?php

namespace OZiTAG\Tager\Backend\Banners\Console;

use Illuminate\Console\Command;
use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Settings\TagerSettingsConfig;

class FlushBannersCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tager:banners-flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync DB Banner Areas with config';

    public function handle(BannerAreasRepository $repository, BannersRepository $bannersRepository, Storage $storage)
    {
        $areas = config()->get('tager-banners.areas');
        if (!$areas) {
            $areas = [];
        }

        $exists = [];

        foreach ($areas as $alias => $area) {
            if (is_string($area)) {
                $label = $area;
                $scenario = null;
            } else {
                $label = $area['label'] ?? null;
                $scenario = $area['scenario'] ?? null;
            }

            $model = $repository->findByAlias($alias);

            if (!$model) {
                $model = $repository->createModelInstance();
                $model->alias = $alias;
            }

            $banners = $bannersRepository->findByBannerArea($model->id);
            foreach ($banners as $banner) {
                if ($banner->image_id) {
                    $storage->setFileScenario($banner->image_id, $scenario);
                }
            }

            $model->label = $label;

            $model->save();

            $exists[] = $model->id;
        }

        foreach ($repository->all() as $bannerArea) {
            if (!in_array($bannerArea->id, $exists)) {
                $bannerArea->delete();
            }
        }
    }
}
