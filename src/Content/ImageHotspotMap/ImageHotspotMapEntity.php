<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspotMap;

use SasImageHotspot\Content\ImageHotspot\ImageHotspotCollection;
use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapTranslation\ImageHotspotMapTranslationCollection;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ImageHotspotMapEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var MediaEntity|null
     */
    protected $media;

    /**
     * @var string
     */
    protected $mediaId;

    /**
     * @var ImageHotspotCollection|null
     */
    protected $hotspots;

    /**
     * @var string|null
     */
    protected $title;

    /**
     * @var ImageHotspotMapTranslationCollection|null
     */
    protected $translations;

    public function getMediaId(): string
    {
        return $this->mediaId;
    }

    public function setMediaId(string $mediaId): void
    {
        $this->mediaId = $mediaId;
    }

    public function getHotspots(): ?ImageHotspotCollection
    {
        return $this->hotspots;
    }

    public function setImageHotspots(ImageHotspotCollection $hotspots): void
    {
        $this->hotspots = $hotspots;
    }

    public function getMedia(): ?MediaEntity
    {
        return $this->media;
    }

    public function setMedia(MediaEntity $media): void
    {
        $this->media = $media;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTranslations(): ?ImageHotspotMapTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(ImageHotspotMapTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }
}
