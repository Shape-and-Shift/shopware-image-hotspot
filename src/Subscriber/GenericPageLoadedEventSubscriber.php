<?php declare(strict_types=1);

namespace SasImageHotspot\Subscriber;

use SasImageHotspot\Content\ImageHotspotMap\ImageHotspotMapEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\NotFilter;
use Shopware\Storefront\Page\GenericPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GenericPageLoadedEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityRepositoryInterface
     */
    private $mapRepository;

    public function __construct(EntityRepositoryInterface $mapRepository)
    {
        $this->mapRepository = $mapRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            GenericPageLoadedEvent::class => 'onGenericPageLoaded',
        ];
    }

    public function onGenericPageLoaded(GenericPageLoadedEvent $event): void
    {
        $page = $event->getPage();

        $criteria = new Criteria();
        $criteria->addAssociations([
            'hotspots.media',
        ]);

        $criteria->getAssociation('hotspots')->addFilter(new NotFilter(NotFilter::CONNECTION_AND, [
            new EqualsFilter('id', null),
        ]));

        $maps = $this->mapRepository->search($criteria, $event->getContext());

        if (empty($maps) || $maps->count() === 0) {
            return;
        }

        $imageMap = [];

        /** @var ImageHotspotMapEntity $map */
        foreach ($maps as $map) {
            $imageMap[$map->getMediaId()] = $map->getHotspots();
        }

        $page->setExtensions([
            'maps' => $imageMap,
        ]);
    }
}
