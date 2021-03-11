<?php declare(strict_types=1);

namespace SasImageHotspot;

use Doctrine\DBAL\Connection;
use SasImageHotspot\Content\ImageHotspot\ImageHotspotDefinition;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsAnyFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Uuid\Uuid;

class SasImageHotspot extends Plugin
{
    public function install(InstallContext $installContext): void
    {
        $this->createHotspotMediaFolder($installContext->getContext());
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        if ($uninstallContext->keepUserData()) {
            return;
        }

        $connection = $this->container->get(Connection::class);

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS=0;');

        $connection->exec('DROP TABLE IF EXISTS sas_image_hotspot_translation;');
        $connection->exec('DROP TABLE IF EXISTS sas_image_hotspot;');
        $connection->exec('DROP TABLE IF EXISTS sas_image_hotspot_map_translation;');
        $connection->exec('DROP TABLE IF EXISTS sas_image_hotspot_map;');

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS=1;');

        $this->deleteDefaultMediaFolder($uninstallContext->getContext());
    }

    public function createHotspotMediaFolder(Context $context): void
    {
        $this->deleteMediaFolder($context);
        $this->deleteDefaultMediaFolder($context);

        /** @var EntityRepositoryInterface $mediaFolderRepository */
        $mediaFolderRepository = $this->container->get('media_default_folder.repository');

        $mediaFolderRepository->create([
            [
                'entity' => ImageHotspotDefinition::ENTITY_NAME,
                'associationFields' => ['media'],
                'folder' => [
                    'name' => 'Hotspot Images',
                    'useParentConfiguration' => false,
                    'configuration' => [
                        'createThumbnails' => true,
                    ],
                ],
            ],
        ], $context);

        $connection = $this->container->get(Connection::class);

        $thumbnailSizes = $this->upsertThumbnailSizes($connection);

        $stmt = $connection->prepare('SELECT media_folder_configuration_id FROM media_folder WHERE name = :name');

        $stmt->execute(['name' => 'Hotspot Images']);
        $configurationId = $stmt->fetchColumn();

        foreach ($thumbnailSizes as $thumbnailSize) {
            $connection->executeUpdate('
                    REPLACE INTO `media_folder_configuration_media_thumbnail_size` (`media_folder_configuration_id`, `media_thumbnail_size_id`)
                    VALUES (:folderConfigurationId, :thumbnailSizeId)
                ', [
                'folderConfigurationId' => $configurationId,
                'thumbnailSizeId' => $thumbnailSize['id'],
            ]);
        }
    }

    private function deleteDefaultMediaFolder(Context $context): void
    {
        $criteria = new Criteria();
        $criteria->addFilter(
            new EqualsAnyFilter('entity', [
                ImageHotspotDefinition::ENTITY_NAME,
            ])
        );

        /** @var EntityRepositoryInterface $mediaFolderRepository */
        $mediaFolderRepository = $this->container->get('media_default_folder.repository');

        $mediaFolderIds = $mediaFolderRepository->searchIds($criteria, $context)->getIds();

        if (!empty($mediaFolderIds)) {
            $ids = array_map(static function ($id) {
                return ['id' => $id];
            }, $mediaFolderIds);
            $mediaFolderRepository->delete($ids, $context);
        }
    }

    private function deleteMediaFolder(Context $context): void
    {
        $criteria = new Criteria();
        $criteria->addFilter(
            new EqualsFilter('name', 'Hotspot Images')
        );

        /** @var EntityRepositoryInterface $mediaFolderRepository */
        $mediaFolderRepository = $this->container->get('media_folder.repository');

        $mediaFolderRepository->search($criteria, $context);

        $mediaFolderIds = $mediaFolderRepository->searchIds($criteria, $context)->getIds();

        if (!empty($mediaFolderIds)) {
            $ids = array_map(static function ($id) {
                return ['id' => $id];
            }, $mediaFolderIds);
            $mediaFolderRepository->delete($ids, $context);
        }
    }

    private function upsertThumbnailSizes(Connection $connection): array
    {
        $thumbnailSizes = [
            ['width' => 400, 'height' => 400],
            ['width' => 800, 'height' => 800],
            ['width' => 1920, 'height' => 1920],
        ];

        $stmt = $connection->prepare('SELECT id FROM media_thumbnail_size WHERE width = :width AND height = :height');
        foreach ($thumbnailSizes as $i => $thumbnailSize) {
            $stmt->execute(['width' => $thumbnailSize['width'], 'height' => $thumbnailSize['height']]);
            $id = $stmt->fetchColumn();
            if ($id) {
                $thumbnailSizes[$i]['id'] = $id;

                continue;
            }
            $id = Uuid::randomBytes();
            $connection->executeUpdate('
                INSERT INTO `media_thumbnail_size` (`id`, `width`, `height`, created_at)
                VALUES (:id, :width, :height, :createdAt)
            ', [
                'id' => $id,
                'width' => $thumbnailSize['width'],
                'height' => $thumbnailSize['height'],
                'createdAt' => (new \DateTime())->format(Defaults::STORAGE_DATE_TIME_FORMAT),
            ]);

            $thumbnailSizes[$i]['id'] = $id;
        }

        return $thumbnailSizes;
    }
}
