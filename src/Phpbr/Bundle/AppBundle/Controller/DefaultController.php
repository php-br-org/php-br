<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function quemsomosAction()
    {
        return $this->render('PhpbrAppBundle::quemsomos.html.twig');
    }

    public function inicialAction()
    {
        return $this->render('PhpbrAppBundle::inicial.html.twig');
    }

    public function contatoAction()
    {
        return $this->render('PhpbrAppBundle::contato.html.twig');
    }

    public function colaboreAction()
    {
        return $this->render('PhpbrAppBundle::colabore.html.twig');
    }
}
