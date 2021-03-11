<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspotMap;

use SasImageHotspot\Content\ImageHotspot\ImageHotspotDefinition;
use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapTranslation\ImageHotspotMapTranslationDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ImageHotspotMapDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'sas_image_hotspot_map';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return ImageHotspotMapEntity::class;
    }

    public function getCollectionClass(): string
    {
        return ImageHotspotMapCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->setFlags(new PrimaryKey(), new Required()),

            (new FkField('media_id', 'mediaId', MediaDefinition::class))->addFlags(new Required()),
            (new TranslatedField('title'))->addFlags(new AllowHtml()),
            new OneToOneAssociationField('media', 'media_id', 'id', MediaDefinition::class, false),
            (new OneToManyAssociationField('hotspots', ImageHotspotDefinition::class, 'map_id'))->addFlags(new CascadeDelete()),

            new TranslatedField('customFields'),
            new TranslationsAssociationField(ImageHotspotMapTranslationDefinition::class, 'sas_image_hotspot_map_id'),
        ]);
    }
}
