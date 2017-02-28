<?php

namespace Sales\OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SalesOrderBundle:Default:index.html.twig');
    }
}
