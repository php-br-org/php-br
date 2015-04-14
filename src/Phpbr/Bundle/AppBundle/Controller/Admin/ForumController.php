<?php

namespace Phpbr\Bundle\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\Bundle\AppBundle\Entity\Forum\Categoria;
use Phpbr\Bundle\AppBundle\Form\Type\ForumCategoriaFormType;

class ForumController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('PhpbrAppBundle:Forum\Categoria')
            ->findAll()
        ;

        return $this->render('PhpbrAppBundle:Admin\Forum:lista.html.twig', 
            compact('categorias')
        );
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function novaCategoriaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('PhpbrAppBundle:Forum\Categoria')
            ->findAll()
        ;

        $categoria = new Categoria();

        $form = $this->createForm(new ForumCategoriaFormType(), $categoria, array());
        $form->handleRequest($request);


        if ($form->isValid()) {
            $categoria->setDataCriacao(new \DateTime());
            $categoria->setStatus(true);

            $em->persist($categoria);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_forum_categorias'));
        }

        return $this->render('PhpbrAppBundle:Admin\Forum:nova-categoria.html.twig', [
            'categorias' => $categorias,
            'form' => $form->createView()
        ]);
    }


    public function deletarAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PhpbrAppBundle:Forum\Categoria')->findOneBy(
                array(
                    'id' => $id
                )
            );

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categoria entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('admin_forum_categorias'));
    }


}


