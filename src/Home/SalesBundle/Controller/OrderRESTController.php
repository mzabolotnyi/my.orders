<?php

namespace Home\SalesBundle\Controller;

use Home\SalesBundle\Entity\Order;
use Home\SalesBundle\Entity\OrderRow;
use Home\SalesBundle\Form\OrderType;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Voryx\RESTGeneratorBundle\Controller\VoryxController;

/**
 * Order controller.
 * @RouteResource("Order")
 */
class OrderRESTController extends VoryxController
{
    /**
     * Get a Order entity
     *
     * @View(serializerGroups={"order_list"})
     *
     * @return Response
     *
     */
    public function getAction(Order $entity)
    {
        return $entity;
    }

    /**
     * Get all Order entities.
     *
     * @View(serializerGroups={"order_list"})
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @return Response
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="20", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, array=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, array=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        try {
            $offset = $paramFetcher->get('offset');
            $limit = $paramFetcher->get('limit');
            $order_by = $paramFetcher->get('order_by');
            $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();

            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('HomeSalesBundle:Order')->findBy($filters, $order_by, $limit, $offset);
            if ($entities) {
                return $entities;
            }

            return [];
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a Order entity.
     *
     * @View(statusCode=201, serializerGroups={"order_list"})
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function postAction(Request $request)
    {
        $entity = new Order();
        $form = $this->createForm(get_class(new OrderType()), $entity, array("method" => $request->getMethod()));
        $this->removeExtraFields($request, $form);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            /** @var OrderRow[] $rows */
            $rows = $entity->getRows();
            foreach ($rows as $row) {
                $row->setOrder($entity);
                $em->persist($row);
            }

            $em->flush();

            return $entity;
        }

        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update a Order entity.
     *
     * @View(serializerGroups={"order_list"})
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request, Order $entity)
    {
        try {
            /** @var OrderRow[] $rowsOld */
            $rowsOld = clone $entity->getRows();

            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm(get_class(new OrderType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);

            if ($form->isValid()) {

                $requestParams = $request->request->all();

                if (isset($requestParams['rows'])) {

                    foreach ($rowsOld as $row) {
                        $em->remove($row);
                    }

                    /** @var OrderRow[] $rows */
                    $rows = $entity->getRows();
                    foreach ($rows as $row) {
                        $row->setOrder($entity);
                        $em->persist($row);
                    }
                } else {
                    foreach ($rowsOld as $row) {
                        $entity->addRow($row);
                    }
                }

                $em->flush();

                return $entity;
            }

            return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a Order entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request, Order $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();

            return null;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
