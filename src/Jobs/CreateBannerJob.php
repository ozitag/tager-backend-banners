<?php

namespace OZiTAG\Tager\Backend\Banners\Jobs;

use Ozerich\FileStorage\Models\File;
use OZiTAG\Tager\Backend\Banners\Models\TagerBannerArea;
use OZiTAG\Tager\Backend\Banners\Repositories\BannersRepository;
use OZiTAG\Tager\Backend\Core\QueueJob;
use OZiTAG\Tager\Backend\Mail\Enums\TagerMailStatus;
use OZiTAG\Tager\Backend\Mail\Exceptions\TagerMailSenderException;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailLog;
use App\Models\Product;
use App\Repositories\Interfaces\IProductReviewRepository;
use OZiTAG\Tager\Backend\Mail\Repositories\MailLogRepository;
use OZiTAG\Tager\Backend\Mail\Senders\SenderFactory;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailAttachments;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailConfig;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailSender;
use OZiTAG\Tager\Backend\Banners\Repositories\BannerAreasRepository;

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

    public function handle(BannersRepository $repository)
    {
        return $repository->create([
            'banner_area_id' => $this->area->id,
            'priority' => $this->priority,
            'title' => $this->title,
            'text' => $this->text,
            'button_link' => $this->buttonLink,
            'button_label' => $this->buttonLabel,
            'button_is_new_tab' => $this->buttonIsNewTab,
            'image_id' => $this->image ? $this->image->id : null
        ]);
    }
}
