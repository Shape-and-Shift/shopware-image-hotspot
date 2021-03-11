<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspotMap;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                       add(ImageHotspotMapEntity $entity)
 * @method void                       set(string $key, ImageHotspotMapEntity $entity)
 * @method ImageHotspotMapEntity[]    getIterator()
 * @method ImageHotspotMapEntity[]    getElements()
 * @method ImageHotspotMapEntity|null get(string $key)
 * @method ImageHotspotMapEntity|null first()
 * @method ImageHotspotMapEntity|null last()
 */
class ImageHotspotMapCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'sas_image_hotspot_map_collection';
    }

    protected function getExpectedClass(): string
    {
        return ImageHotspotMapEntity::class;
    }
}
