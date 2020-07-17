<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use Ozerich\FileStorage\Models\File;
use Ozerich\FileStorage\Repositories\FileRepository;
use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;

class CreateBannerJob
{
    private $area;

    private $title;

    private $priority;

    private $text;

    private $buttonLink;

    private $buttonLabel;

    private $buttonIsNewTab;

    /** @var File */
    private $image;

    public function __construct(TagerBannerArea $area, $title, $text, $buttonLink, $buttonLabel, $buttonIsNewTab, $image, $priority)
    {
        $this->area = $area;
        $this->priority = $priority;
        $this->title = $title;
        $this->text = $text;
        $this->buttonLink = $buttonLink;
        $this->buttonLabel = $buttonLabel;
        $this->buttonIsNewTab = $buttonIsNewTab;
        $this->image = $image;
    }

    public function handle(BannersRepository $repository, Storage $fileStorage, FileRepository $fileRepository)
    {
        if ($this->image) {
            $fileModel = $fileRepository->find($this->image);

            if (!$fileModel) {
                $this->image = null;
            } elseif ($this->area->scenario) {
                $fileStorage->setFileScenario($this->image, $this->area->scenario);
            }
        }

        return $repository->create([
            'banner_area_id' => $this->area->id,
            'priority' => $this->priority,
            'title' => $this->title,
            'text' => $this->text,
            'button_link' => $this->buttonLink,
            'button_label' => $this->buttonLabel,
            'button_is_new_tab' => $this->buttonIsNewTab,
            'image_id' => $this->image
        ]);
    }
}
