<?php
/**
 * @file
 * Contains ResourceController.
 */

namespace Koba\AdminBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * @Route("/resources")
 */
class ResourceController extends FOSRestController
{
    /**
     * Get resources.
     *
     * @FOSRest\Get("")
     *
     * @View(serializerGroups={"admin"})
     * @return array
     */
    public function getResourcesAction()
    {
        return $this->get('itk.exchange_service')->getResources();
    }

    /**
     * Get resource by mail.
     *
     * @FOSRest\Get("/{mail}")
     *
     * @View(serializerGroups={"admin"})
     * @return Resource
     */
    public function getResourceByMailAction($mail)
    {
        return $this->get('itk.exchange_service')->getResourceByMail($mail);
    }


    /**
     * Refresh resources.
     *
     * @FOSRest\Post("/refresh")
     */
    public function refreshResources()
    {
        $this->get('itk.exchange_service')->refreshResources();
    }

    /**
     * Update resource alias
     *
     * @FOSRest\Put("/{resourceMail}/alias")
     *
     * @param Request $request
     * @param string $resourceMail
     */
    public function setResourceAlias(Request $request, $resourceMail)
    {
        $resource = json_decode($request->getContent());

        $this->get('itk.exchange_service')->setResourceAlias(
            $resourceMail,
            $resource->alias
        );
    }
}
