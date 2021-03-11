<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspot\ImageHotspotTranslation;

use SasImageHotspot\Content\ImageHotspot\ImageHotspotEntity;
use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;

class ImageHotspotTranslationEntity extends TranslationEntity
{
    /**
     * @var string
     */
    protected $hotspotId;

    /**
     * @var ImageHotspotEntity|null
     */
    protected $hotspot;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string|null
     */
    protected $link;

    /**
     * @var bool|null
     */
    protected $openNewTab;

    /**
     * @var string|null
     */
    protected $title;

    public function getHotspotId(): string
    {
        return $this->hotspotId;
    }

    public function setHotspotId(string $hotspotId): void
    {
        $this->hotspotId = $hotspotId;
    }

    public function getHotspot(): ?ImageHotspotEntity
    {
        return $this->hotspot;
    }

    public function setHotspot(ImageHotspotEntity $hotspot): void
    {
        $this->hotspot = $hotspot;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getOpenNewTab(): ?bool
    {
        return $this->openNewTab;
    }

    public function setOpenNewTab(bool $openNewTab): void
    {
        $this->openNewTab = $openNewTab;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
