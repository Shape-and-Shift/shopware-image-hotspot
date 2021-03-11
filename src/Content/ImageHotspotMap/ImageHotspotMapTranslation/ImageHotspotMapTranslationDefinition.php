<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapTranslation;

use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CustomFields;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ImageHotspotMapTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = ImageHotspotMapDefinition::ENTITY_NAME . '_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return ImageHotspotMapTranslationCollection::class;
    }

    public function getEntityClass(): string
    {
        return ImageHotspotMapTranslationEntity::class;
    }

    protected function getParentDefinitionClass(): string
    {
        return ImageHotspotMapDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new StringField('title', 'title'))->addFlags(new AllowHtml()),
            new CustomFields(),
        ]);
    }
}
