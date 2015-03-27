<?php

namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Phpbr\Bundle\AppBundle\Entity\Forum\Topico;
use Phpbr\Bundle\AppBundle\Entity\Forum\Categoria;


class MensagemController extends Controller
{

    public function verMensagemAction(Topico $topico)
    {
        /*
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $topicos = $em->getRepository('PhpbrAppBundle:Forum\Topico')
            ->findBy(
                array('categoria' => $id),
                array('id' => 'DESC')
            );

        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('PhpbrAppBundle:Forum\Categoria')
            ->find($id);

        // $session->set('forumCategoria', $categoria->getId());
        */

        /*
        $em = $this->getDoctrine()->getManager();
        $mensages = $em->getRepository('PhpbrAppBundle:Forum\Topico')
            ->findBy(
                array('categoria' => $id),
                array('id' => 'DESC')
            );
        */

        return $this->render('PhpbrAppBundle:Forum:verMensagem.html.twig', array(
            'topico' => $topico
        ));

    }

    public function novaMensagemAction($topico_id)
    {
        return $this->render('PhpbrAppBundle:Forum:novaMensagem.html.twig', array(
                // ...
            ));
    }

    public function deletarMensagemAction($id)
    {
        return $this->render('PhpbrAppBundle:Forum:deletarMensagem.html.twig', array(
                // ...
            ));
    }

}

