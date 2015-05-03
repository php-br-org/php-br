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
    /**
     * @param Topico $topico
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function verMensagemAction(Topico $topico, Request $request)
    {
        $mensagem = new Mensagem();
        $form = $this->createForm(new ForumMensagemFormType(), $mensagem, array());
        $form->handleRequest($request);
        $usuario = $this->get('security.context')->getToken()->getUser();

        $topico_id = $topico->getId();

        if ($form->isValid()) {
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
            'mensagens' => $mensagens,
            'usuario' => $usuario
        ));
    }

    /**
     * @param $topico_id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function novaMensagemAction($topico_id)
    {
        return $this->render('PhpbrAppBundle:Forum:novaMensagem.html.twig', array(
                // ...
            ));
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletarMensagemAction($id)
    {
        $usuario = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $mensagem = $em->getRepository('PhpbrAppBundle:Forum\Mensagem')
            ->findOneBy(
                array('id' => $id)
            );

        if (!$mensagem) {
            throw $this->createNotFoundException('Unable to find mensagem entity.');
        }


        if ($mensagem->getUser() != $usuario){
            throw $this->createNotFoundException('Unable to find mensagem entity.');
        }

        $topico = $mensagem->getTopico();

        $em->remove($mensagem);
        $em->flush();

            $this->addFlash(
                'notice',
                'Mensagem deletada com sucesso!'
            );

        $em = $this->getDoctrine()->getManager();
        $mensagens = $em->getRepository('PhpbrAppBundle:Forum\Mensagem')
            ->findBy(
                array('topico' => $topico)
            );

        $mensagem = new Mensagem();
        $form = $this->createForm(new ForumMensagemFormType(), $mensagem, array());

        return $this->redirect(
            $this->generateUrl(
                'forum_ver_mensagem',
                array(
                    'slug_categoria' => $topico->getCategoria()->getSlug(),
                    'slug' => $topico->getSlug()
                )
            )
        );
    }

    /**
     * @param $categoria_id
     *
     * @return mixed
     */
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

