<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspot;

use SasImageHotspot\Content\ImageHotspot\ImageHotspotTranslation\ImageHotspotTranslationDefinition;
use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FloatField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ImageHotspotDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'sas_image_hotspot';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return ImageHotspotEntity::class;
    }

    public function getCollectionClass(): string
    {
        return ImageHotspotCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->setFlags(new PrimaryKey(), new Required()),

            (new FkField('map_id', 'mapId', ImageHotspotMapDefinition::class))->addFlags(new Required()),

            (new FloatField('top', 'top'))->addFlags(new Required()),
            (new FloatField('left', 'left'))->addFlags(new Required()),

            (new TranslatedField('description'))->addFlags(new AllowHtml()),
            (new TranslatedField('title'))->addFlags(new AllowHtml()),
            new TranslatedField('link'),
            new TranslatedField('customFields'),
            new TranslatedField('openNewTab'),

            new FkField('product_id', 'productId', ProductDefinition::class),
            new FkField('media_id', 'mediaId', MediaDefinition::class),
            new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id', false),
            new ManyToOneAssociationField('media', 'media_id', MediaDefinition::class, 'id', false),

            new ManyToOneAssociationField('map', 'map_id', ImageHotspotMapDefinition::class, 'id', false),

            (new TranslationsAssociationField(ImageHotspotTranslationDefinition::class, 'sas_image_hotspot_id'))->addFlags(new Required()),
        ]);
    }
}
