<?php

namespace Sales\OrderBundle\Controller;

use JMS\Serializer\Serializer;
use Sales\OrderBundle\Helpers\SerializerHelper;
use Sales\OrderBundle\Repository\OrderStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class OrderStatusController
 * @Route("/orderStatus")
 */
class OrderStatusController extends Controller
{
    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function getAllAction()
    {
        /** @var OrderStatusRepository $orderStatusRepo */
        $orderStatusRepo = $this->getDoctrine()->getManager()->getRepository('SalesOrderBundle:OrderStatus');
        $orderStatuses = $orderStatusRepo->findAll();

        /** @var Serializer $serializer */
        $serializer = $this->get('jms_serializer');
        $context = SerializerHelper::createContext(['order_status_list']);
        $responseData = json_decode($serializer->serialize($orderStatuses, 'json', $context));

        return new JsonResponse($responseData);
    }
}
