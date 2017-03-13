<?php

namespace Home\MediaBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Home\MediaBundle\Entity\Media;
use Home\MediaBundle\Service\UploaderService;


class TransformMediaDataSubscriber implements EventSubscriber
{
    /** @var UploaderService $uploader */
    private $uploader;

    public function __construct(UploaderService $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate
        );
    }

    /**
     * @param LifecycleEventArgs $lifecycleEventArgs
     */
    public function prePersist(LifecycleEventArgs $lifecycleEventArgs)
    {
        /** @var Media $entity */
        $entity = $lifecycleEventArgs->getEntity();

        if (!$entity instanceof Media) {
            return;
        }

        $this->transformMediaData($entity);
    }

    /**
     * @param LifecycleEventArgs $lifecycleEventArgs
     */
    public function preUpdate(LifecycleEventArgs $lifecycleEventArgs)
    {
        /** @var Media $entity */
        $entity = $lifecycleEventArgs->getEntity();

        if (!$entity instanceof Media) {
            return;
        }

        $this->transformMediaData($entity);
    }

    /**
     * Create file from media data (string in base64) and set path to media entity
     *
     * @param Media $media
     */
    public function transformMediaData(Media $media)
    {
        $base64string = $media->getData();

        if (!$base64string) {
            return;
        }

        $path = $this->uploader->uploadFromBase64($base64string, $media->getOrigin());

        $media->setPath($path);
    }
}