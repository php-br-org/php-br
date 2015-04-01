<?php

namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Phpbr\Bundle\AppBundle\Form\Type\ForumMensagemFormType;
use Phpbr\Bundle\AppBundle\Entity\Forum\Topico;
use Phpbr\Bundle\AppBundle\Entity\Forum\Categoria;
use Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem;


class MensagemController extends Controller
{

    public function verMensagemAction(Topico $topico, Request $request)
    {
        $mensagem = new Mensagem();
        $form = $this->createForm(new ForumMensagemFormType(), $mensagem, array());
        $form->handleRequest($request);
        $usuario = $this->get('security.context')->getToken()->getUser();

        $topico_id = $topico->getId();

        if ($form->isValid()) {
            if ('anon.' == $usuario) {
                return $this->redirect($this->generateUrl('fos_user_security_login'));
            }

            $mensagem->setUser($usuario);
            $mensagem->setTopico($topico);
            $mensagem->setDataCriacao(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($mensagem);
            $em->flush();

            $topico = $em->getRepository('PhpbrAppBundle:Forum\Topico')
                ->find($topico_id);

        }

        if ('anon.' == $usuario) {
            $form = $this->createForm(new ForumMensagemFormType(), $mensagem, array(
                'disabled' => true
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $mensagens = $em->getRepository('PhpbrAppBundle:Forum\Mensagem')
            ->findBy(
                array('topico' => $topico)
            );

        return $this->render('PhpbrAppBundle:Forum:verMensagem.html.twig', array(
            'topico' => $topico,
            'form' => $form->createView(),
            'mensagens' => $mensagens
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

    public function topicos2ultimaMensagem($categoria_id)
    {
        $em = $this->getDoctrine()->getManager();
        $ultimoTopico = $em->getRepository('PhpbrAppBundle:Forum\Topico')
            ->findBy(
                array('categoria' => $categoria_id),
                array('id' => 'DESC'),
                1
            );

        return $ultimoTopico;
    }

}

