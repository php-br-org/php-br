<?php

namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TopicoController extends Controller
{
    public function indexAction()
    {
        return $this->render('PhpbrAppBundle:Forum:index.html.twig', array(
                // ...
            ));    }

    public function verAction($id)
    {
        return $this->render('PhpbrAppBundle:Forum:ver.html.twig', array(
                // ...
            ));    }

    public function novoAction()
    {
        return $this->render('PhpbrAppBundle:Forum:novo.html.twig', array(
                // ...
            ));    }

    public function deletarAction($id)
    {
        return $this->render('PhpbrAppBundle:Forum:deletar.html.twig', array(
                // ...
            ));    }

}

