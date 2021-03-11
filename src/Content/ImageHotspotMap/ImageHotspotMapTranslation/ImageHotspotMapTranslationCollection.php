<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                                  add(ImageHotspotMapTranslationEntity $entity)
 * @method void                                  set(string $key, ImageHotspotMapTranslationEntity $entity)
 * @method ImageHotspotMapTranslationEntity[]    getIterator()
 * @method ImageHotspotMapTranslationEntity[]    getElements()
 * @method ImageHotspotMapTranslationEntity|null get(string $key)
 * @method ImageHotspotMapTranslationEntity|null first()
 * @method ImageHotspotMapTranslationEntity|null last()
 */
class ImageHotspotMapTranslationCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'sas_image_hotspot_map_translation_collection';
    }

    protected function getExpectedClass(): string
    {
        return ImageHotspotMapTranslationEntity::class;
    }
}
