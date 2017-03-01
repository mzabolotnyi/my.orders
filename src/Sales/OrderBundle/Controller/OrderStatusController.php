<?php

namespace Sales\OrderBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Sales\OrderBundle\Repository\OrderStatusRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class OrderStatusController
 * @Route("/statuses")
 */
class OrderStatusController extends FOSRestController
{
    /**
     * Get list action
     *
     * @Route("")
     * @Method("GET")
     * @return JsonResponse
     */
    public function getAllAction()
    {
        /** @var OrderStatusRepository $repo */
        $repo = $this->getDoctrine()->getManager()->getRepository('SalesOrderBundle:OrderStatus');
        $items = $repo->findAll();

        /** @var Serializer $serializer */
        $serializer = $this->get('jms_serializer');

        $context = new SerializationContext();
        $context->setGroups(['order_status_list'])
            ->setSerializeNull(true);

        $responseData = json_decode($serializer->serialize($items, 'json', $context), true);

        return new JsonResponse($responseData);
    }
}
