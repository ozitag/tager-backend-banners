<?php

namespace OZiTAG\Tager\Backend\Banners\Commands;

use Illuminate\Console\Command;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailTemplate;
use OZiTAG\Tager\Backend\Mail\Repositories\MailTemplateRepository;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;
use OZiTAG\Tager\Backend\Seo\Models\SeoPage;
use OZiTAG\Tager\Backend\Seo\Repositories\SeoPageRepository;

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
        $areas = config()->get('tager-banners.area');
        if (!$areas) {
            return;
        }

        foreach ($areas as $alias => $label) {
            $model = $repository->findByAlias($alias);

            if (!$model) {
                $model = $repository->createModelInstance();
                $model->alias = $alias;
            }

            $model->label = $label;
            $model->save();
        }
    }
}
