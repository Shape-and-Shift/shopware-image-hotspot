<?php declare(strict_types=1);

namespace SasImageHotspot\Content\Extension;

use SasImageHotspot\Content\ImageHotspot\ImageHotspotDefinition;
use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class MediaEntityExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToOneAssociationField('hotspotMap', 'id', 'media_id', ImageHotspotMapDefinition::class, false))->addFlags(new CascadeDelete())
        );

        $collection->add(
            (new OneToManyAssociationField('hotspots', ImageHotspotDefinition::class, 'media_id', 'id'))->addFlags(new CascadeDelete())
        );
    }

    public function getDefinitionClass(): string
    {
        return MediaDefinition::class;
    }
}
