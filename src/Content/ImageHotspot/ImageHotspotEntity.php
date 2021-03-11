<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspot;

use SasImageHotspot\Content\ImageHotspot\ImageHotspotTranslation\ImageHotspotTranslationCollection;
use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapEntity;
use Shopware\Core\Content\Product\SalesChannel\SalesChannelProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ImageHotspotEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $mapId;

    /**
     * @var ImageHotspotMapEntity|null
     */
    protected $map;

    /**
     * @var float
     */
    protected $top;

    /**
     * @var float
     */
    protected $left;

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

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string|null
     */
    protected $productId;

    /**
     * @var string|null
     */
    protected $mediaId;

    /**
     * @var SalesChannelProductEntity|null
     */
    protected $salesChannelProduct;

    /**
     * @var ImageHotspotTranslationCollection|null
     */
    protected $translations;

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

    public function getTop(): float
    {
        return $this->top;
    }

    public function setTop(float $top): void
    {
        $this->top = $top;
    }

    public function getLeft(): float
    {
        return $this->left;
    }

    public function setLeft(float $left): void
    {
        $this->left = $left;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getSalesChannelProduct(): ?SalesChannelProductEntity
    {
        return $this->salesChannelProduct;
    }

    public function setSalesChannelProduct(SalesChannelProductEntity $salesChannelProduct): void
    {
        $this->salesChannelProduct = $salesChannelProduct;
    }

    public function getTranslations(): ?ImageHotspotTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(ImageHotspotTranslationCollection $translations): void
    {
        $this->translations = $translations;
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

    public function getMediaId(): ?string
    {
        return $this->mediaId;
    }

    public function setMediaId(?string $mediaId): void
    {
        $this->mediaId = $mediaId;
    }
}
