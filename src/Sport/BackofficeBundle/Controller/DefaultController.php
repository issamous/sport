<?php

namespace Sport\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SportBackofficeBundle:Default:index.html.twig');
    }
}
