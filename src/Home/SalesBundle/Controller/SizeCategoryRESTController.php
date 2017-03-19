<?php

namespace Home\SalesBundle\Controller;

use Home\SalesBundle\Entity\Size;
use Home\SalesBundle\Entity\SizeCategory;
use Home\SalesBundle\Form\SizeCategoryType;
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
 * SizeCategory controller.
 * @RouteResource("SizeCategory")
 */
class SizeCategoryRESTController extends VoryxController
{
    /**
     * Get a SizeCategory entity
     *
     * @View(serializerGroups={"size_type_list"})
     *
     * @return Response
     *
     */
    public function getAction(SizeCategory $entity)
    {
        return $entity;
    }

    /**
     * Get all SizeCategory entities.
     *
     * @View(serializerGroups={"size_type_list"})
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
            $entities = $em->getRepository('HomeSalesBundle:SizeCategory')->findBy($filters, $order_by, $limit, $offset);
            if ($entities) {
                return $entities;
            }

            return [];
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a SizeCategory entity.
     *
     * @View(statusCode=201, serializerGroups={"size_type_list"})
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function postAction(Request $request)
    {
        $entity = new SizeCategory();
        $form = $this->createForm(get_class(new SizeCategoryType()), $entity, array("method" => $request->getMethod()));
        $this->removeExtraFields($request, $form);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            /** @var Size[] $sizes */
            $sizes = $entity->getSizes();
            foreach ($sizes as $size) {
                $size->setCategory($entity);
                $em->persist($size);
            }

            $em->flush();

            return $entity;
        }

        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update a SizeCategory entity.
     *
     * @View(serializerGroups={"size_type_list"})
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request, SizeCategory $entity)
    {
        try {
            /** @var Size[] $sizesOld */
            $sizesOld = clone $entity->getSizes();
            $em = $this->getDoctrine()->getManager();

            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm(get_class(new SizeCategoryType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {

                foreach ($sizesOld as $size) {
                    $em->remove($size);
                }

                /** @var Size[] $sizes */
                $sizes = $entity->getSizes();
                foreach ($sizes as $size) {
                    $size->setCategory($entity);
                    $em->persist($size);
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
     * Delete a SizeCategory entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request, SizeCategory $entity)
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
