<?php

namespace Sport\BackofficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function indexAction()
    {
        return $this->render('SportBackofficeBundle:Default:index.html.twig');
    }

    public function listeAction()
    {
         return $this->render('SportBackofficeBundle:categories:liste.html.twig');
    }

    public function ajoutAction()
    {
         return $this->render('SportBackofficeBundle:categories:ajout.html.twig');
    }
}
