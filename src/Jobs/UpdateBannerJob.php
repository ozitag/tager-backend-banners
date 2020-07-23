<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use Ozerich\FileStorage\Models\File;
use Ozerich\FileStorage\Repositories\FileRepository;
use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Banners\Models\TagerBanner;

class UpdateBannerJob extends Job
{
    private $model;

    private $title;

    private $text;

    private $buttonLink;

    private $buttonLabel;

    private $buttonIsNewTab;

    /** @var File */
    private $image;

    public function __construct(TagerBanner $model, $title, $text, $buttonLink, $buttonLabel, $buttonIsNewTab, $image)
    {
        $this->model = $model;
        $this->title = $title;
        $this->text = $text;
        $this->buttonLink = $buttonLink;
        $this->buttonLabel = $buttonLabel;
        $this->buttonIsNewTab = $buttonIsNewTab;
        $this->image = $image;
    }

    public function handle(FileRepository $fileRepository, Storage $fileStorage)
    {
        if ($this->model->image_id != $this->image) {
            $fileModel = $fileRepository->find($this->image);

            if (!$fileModel) {
                $this->image = null;
            } elseif ($this->model->area->scenario) {
                $fileStorage->setFileScenario($this->image, $this->model->area->scenario);
            }
        }

        $this->model->title = $this->title;
        $this->model->text = $this->text;
        $this->model->button_link = $this->buttonLink;
        $this->model->button_label = $this->buttonLabel;
        $this->model->button_is_new_tab = $this->buttonIsNewTab;
        $this->model->image_id = $this->image;
        $this->model->save();

        return $this->model;
    }
}
