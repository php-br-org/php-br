<?php

namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\Bundle\AppBundle\Entity\Forum\Topico;
use Phpbr\Bundle\AppBundle\Entity\Forum\Categoria;
use Phpbr\Bundle\AppBundle\Form\Type\ForumTopicoFormType;


class TopicoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('PhpbrAppBundle:Forum\Categoria')->findAll();

        return $this->render('PhpbrAppBundle:Forum:index.html.twig', array(
            'categorias' => $categorias
        ));
    }

    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $topicos = $em->getRepository('PhpbrAppBundle:Forum\Topico')
            ->find($id);

        return $this->render('PhpbrAppBundle:Forum:ver.html.twig', array(

        ));
    }

    public function verTopicoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $topicos = $em->getRepository('PhpbrAppBundle:Forum\Topico')
            ->find($id);

        return $this->render('PhpbrAppBundle:Forum:ver.html.twig', array(
            'topicos' => $topicos
        ));
    }

    public function novoAction(Request $request)
    {
        $topico = new Topico();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ForumTopicoFormType(), $topico, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $usuario = $this->get('security.context')->getToken()->getUser();
            $artigo->setUser($usuario);

            $entityManager->persist($artigo);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('lista_meus_artigos'));
        }

        return $this->render('PhpbrAppBundle:Forum:novo.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function deletarAction($id)
    {
        return $this->render('PhpbrAppBundle:Forum:deletar.html.twig', array(
                // ...
            ));    }

}

