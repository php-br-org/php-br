<?php

namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Phpbr\Bundle\AppBundle\Entity\Forum\Topico;
use Phpbr\Bundle\AppBundle\Entity\Forum\Categoria;
use Phpbr\Bundle\AppBundle\Form\Type\ForumTopicoFormType;



class TopicoController extends Controller
{
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

        $session->set('forumCategoria', $categoria->getId());

        return $this->render('PhpbrAppBundle:Forum:ver.html.twig', array(
            'categoria' => $categoria,
            'topicos' => $topicos
        ));
    }

    public function novoAction(Request $request)
    {
        $topico = new Topico();
        $em = $this->getDoctrine()->getManager();
        $session = new Session();

        $categoriaId = $session->get('forumCategoria');
        $emCategoria = $this->getDoctrine()->getManager();
        $categoria = $emCategoria->getRepository('PhpbrAppBundle:Forum\Categoria')
            ->find($categoriaId);

        $usuario = $this->get('security.context')->getToken()->getUser();

        if ('anon.' == $usuario) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $form = $this->createForm(new ForumTopicoFormType(), $topico, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $topico->setUser($usuario);

            $topico->setCategoria($categoria);
            $topico->setDataCriacao(new \DateTime());

            $em->persist($topico);
            $em->flush();

            return $this->redirect($this->generateUrl('ver_topico',
                array(
                    'id' => $categoriaId
                )
            ));
        }

        return $this->render('PhpbrAppBundle:Forum:novo.html.twig', array(
            'form' => $form->createView(),
            'categoria' => $categoria
        ));
    }


    public function deletarAction($id)
    {
        return $this->render('PhpbrAppBundle:Forum:deletar.html.twig', array(
                // ...
        ));    
    }

}

