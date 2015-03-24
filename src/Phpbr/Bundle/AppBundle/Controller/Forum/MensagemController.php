<?php

namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MensagemController extends Controller
{
    public function novaMensagemAction($topico_id)
    {
        return $this->render('PhpbrAppBundle:Forum:novaMensagem.html.twig', array(
                // ...
            ));    }

    public function deletarMensagemAction($id)
    {
        return $this->render('PhpbrAppBundle:Forum:deletarMensagem.html.twig', array(
                // ...
            ));    }

}

