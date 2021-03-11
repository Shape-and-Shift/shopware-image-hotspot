<?php declare(strict_types=1);

namespace SasImageHotspot\TwigExtension;

use Twig\Extension\AbstractExtension;

class CustomThumbnailExtension extends AbstractExtension
{
    public function getTokenParsers(): array
    {
        return [
            new CustomThumbnailTokenParser(),
        ];
    }
}
