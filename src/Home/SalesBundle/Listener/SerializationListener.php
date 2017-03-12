<?php

namespace Home\SalesBundle\Listener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Home\SalesBundle\Entity\Source;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SerializationListener
 */
class SerializationListener implements EventSubscriberInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * SerializationListener constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    static public function getSubscribedEvents()
    {
        return array(
            array('event' => 'serializer.post_serialize', 'class' => Source::class, 'method' => 'onPostSerializeSource')
        );
    }

    /**
     * @param ObjectEvent $event
     */
    public function onPostSerializeSource(ObjectEvent $event)
    {
//        /** @var UploaderHelper $uploaderHelper */
//        $uploaderHelper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
//        $url = $uploaderHelper->asset($event->getObject(), 'image');
//        $event->getVisitor()->addData('image', $url);
    }
}