<?php

namespace OZiTAG\Tager\Backend\Banners\Console;

use Illuminate\Console\Command;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;

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

    public function handle(BannerAreasRepository $repository)
    {
        $areas = config()->get('tager-banners.areas');
        if (!$areas) {
            return;
        }

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

            $model->scenario = $scenario;
            $model->label = $label;

            $model->save();
        }
    }
}