<?php declare(strict_types=1);

namespace SasImageHotspot\Content\ImageHotspot\ImageHotspotTranslation;

use SasImageHotspot\Content\ImageHotspot\ImageHotspotDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CustomFields;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ImageHotspotTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = ImageHotspotDefinition::ENTITY_NAME . '_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return ImageHotspotTranslationCollection::class;
    }

    public function getEntityClass(): string
    {
        return ImageHotspotTranslationEntity::class;
    }

    public function getDefaults(): array
    {
        return [
            'openNewTab' => true,
        ];
    }

    protected function getParentDefinitionClass(): string
    {
        return ImageHotspotDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new LongTextField('description', 'description'))->addFlags(new AllowHtml()),
            (new StringField('title', 'title'))->addFlags(new AllowHtml()),
            new StringField('link', 'link'),
            new BoolField('open_new_tab', 'openNewTab'),

            new CustomFields(),
        ]);
    }
}
