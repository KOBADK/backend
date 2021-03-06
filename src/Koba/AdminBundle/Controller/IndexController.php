<?php
/**
 * @file
 * Contains index controller for AdminBundle.
 */

namespace Koba\AdminBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * @Route("")
 */
class IndexController extends FOSRestController
{
    /**
     * Get index.
     *
     * @FOSRest\Get("")
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
