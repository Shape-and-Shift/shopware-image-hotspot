<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspot;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                    add(ImageHotspotEntity $entity)
 * @method void                    set(string $key, ImageHotspotEntity $entity)
 * @method ImageHotspotEntity[]    getIterator()
 * @method ImageHotspotEntity[]    getElements()
 * @method ImageHotspotEntity|null get(string $key)
 * @method ImageHotspotEntity|null first()
 * @method ImageHotspotEntity|null last()
 */
class ImageHotspotCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'sas_image_hotspot_collection';
    }

    protected function getExpectedClass(): string
    {
        return ImageHotspotEntity::class;
    }
}
