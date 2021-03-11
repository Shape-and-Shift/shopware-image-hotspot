<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspot\ImageHotspotTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                               add(ImageHotspotTranslationEntity $entity)
 * @method void                               set(string $key, ImageHotspotTranslationEntity $entity)
 * @method ImageHotspotTranslationEntity[]    getIterator()
 * @method ImageHotspotTranslationEntity[]    getElements()
 * @method ImageHotspotTranslationEntity|null get(string $key)
 * @method ImageHotspotTranslationEntity|null first()
 * @method ImageHotspotTranslationEntity|null last()
 */
class ImageHotspotTranslationCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'sas_image_hotspot_translation_collection';
    }

    protected function getExpectedClass(): string
    {
        return ImageHotspotTranslationEntity::class;
    }
}
