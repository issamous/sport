<?php

namespace Sport\BackofficeBundle\Controller;

use Sport\BackofficeBundle\Entity\Categories;
use Sport\BackofficeBundle\Entity\PhotoCategorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class NewsController extends Controller
{
    public function indexAction()
    {
        return $this->render('SportBackofficeBundle:Default:index.html.twig');
    }

    public  function listeAction()
    {

        return $this->render('SportBackofficeBundle:News:liste.html.twig');
    }


    public  function AjoutAction()
    {

        return $this->render('SportBackofficeBundle:News:ajout.html.twig');
    }

}

