<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapTranslation;

use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapEntity;
use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;
use Shopware\Core\System\Language\LanguageEntity;

class ImageHotspotMapTranslationEntity extends TranslationEntity
{
    /**
     * @var string
     */
    protected $mapId;

    /**
     * @var ImageHotspotMapEntity
     */
    protected $map;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var LanguageEntity|null
     */
    protected $language;

    /**
     * @var string
     */
    protected $title;

    public function getMapId(): string
    {
        return $this->mapId;
    }

    public function setMapId(string $mapId): void
    {
        $this->mapId = $mapId;
    }

    public function getMap(): ?ImageHotspotMapEntity
    {
        return $this->map;
    }

    public function setMap(ImageHotspotMapEntity $map): void
    {
        $this->map = $map;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
