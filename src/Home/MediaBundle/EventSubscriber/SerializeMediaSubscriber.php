<?php

namespace Home\MediaBundle\EventSubscriber;

use Home\MediaBundle\Entity\Media;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\JsonSerializationVisitor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class SerializeMediaSubscriber implements EventSubscriberInterface
{
    /** @var Request $request */
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @inheritdoc
     */
    static public function getSubscribedEvents()
    {
        return array(
            array('event' => 'serializer.post_serialize', 'class' => 'Home\MediaBundle\Entity\Media', 'method' => 'onPostSerialize'),
        );
    }

    public function onPostSerialize(ObjectEvent $event)
    {
        /** @var JsonSerializationVisitor $visitor */
        $visitor = $event->getVisitor();

        /** @var Media $media */
        $media = $event->getObject();

        if ($media->getPath()) {
            $fullPath = $this->request->getSchemeAndHttpHost() . $media->getPath();
            $visitor->setData('path', $fullPath);
        }
    }
}