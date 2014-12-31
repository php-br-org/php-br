<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PhpbrAppBundle:Default:index.html.twig', array('name' => $name));
    }

    public function quemsomosAction()
    {
        return $this->render('PhpbrAppBundle::quemsomos.html.twig');
    }
}
