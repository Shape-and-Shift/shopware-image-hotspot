<?php declare(strict_types=1);

namespace SasImageHotspot\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1606761373CreateSasImageHotspot extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1606761373;
    }

    public function update(Connection $connection): void
    {
        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `sas_image_hotspot_map` (
                `id` BINARY(16) NOT NULL,
                `media_id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `fk.sas_image_hotspot_map.media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `sas_image_hotspot_map_translation` (
              `sas_image_hotspot_map_id`    BINARY(16)                         NOT NULL,
              `language_id`         BINARY(16)                              NOT NULL,
              `title`                VARCHAR(255) NULL,
              `custom_fields`       JSON                                    NULL,
              `created_at`          DATETIME(3)                             NOT NULL,
              `updated_at`          DATETIME(3)                             NULL,
              PRIMARY KEY (`sas_image_hotspot_map_id`, `language_id`),
              CONSTRAINT `json.sas_image_hotspot_map_translation.custom_fields` CHECK (JSON_VALID(`custom_fields`)),
              CONSTRAINT `fk.sas_image_hotspot_map_translation.language_id` FOREIGN KEY (`language_id`)
                REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.sas_image_hotspot_map_translation.sas_image_hotspot_map_id` FOREIGN KEY (`sas_image_hotspot_map_id`)
                REFERENCES `sas_image_hotspot_map` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `sas_image_hotspot` (
                `id` BINARY(16) NOT NULL,
                `map_id` BINARY(16) NOT NULL,
                `product_id` BINARY(16) NULL,
                `media_id` BINARY(16) NULL,
                `top` FLOAT NOT NULL,
                `left` FLOAT NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
              CONSTRAINT `fk.sas_image_hotspot.product_id` FOREIGN KEY (`product_id`)
                REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
              CONSTRAINT `fk.sas_image_hotspot.media_id` FOREIGN KEY (`media_id`)
                REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `fk.sas_image_hotspot.map_id` FOREIGN KEY (`map_id`) REFERENCES `sas_image_hotspot_map` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `sas_image_hotspot_translation` (
              `sas_image_hotspot_id`    BINARY(16)                         NOT NULL,
              `language_id`         BINARY(16)                              NOT NULL,
              `title`                VARCHAR(255) NULL,
              `description`                LONGTEXT NULL,
              `link`                LONGTEXT NULL,
              `open_new_tab`                TINYINT(1)      NOT NULL DEFAULT 1,
              `custom_fields`       JSON                                    NULL,
              `created_at`          DATETIME(3)                             NOT NULL,
              `updated_at`          DATETIME(3)                             NULL,
              PRIMARY KEY (`sas_image_hotspot_id`, `language_id`),
              CONSTRAINT `json.sas_image_hotspot_translation.custom_fields` CHECK (JSON_VALID(`custom_fields`)),
              CONSTRAINT `fk.sas_image_hotspot_translation.language_id` FOREIGN KEY (`language_id`)
                REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk.sas_image_hotspot_translation.sas_image_hotspot_id` FOREIGN KEY (`sas_image_hotspot_id`)
                REFERENCES `sas_image_hotspot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
