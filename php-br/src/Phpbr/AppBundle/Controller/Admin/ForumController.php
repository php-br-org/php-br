<?php

namespace Phpbr\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\AppBundle\Entity\Forum\Category;
use Phpbr\AppBundle\Form\Type\ForumCategoryFormType;

class ForumController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('PhpbrAppBundle:Forum\Category')
            ->findAll()
        ;

        return $this->render('PhpbrAppBundle:Admin\Forum:list.html.twig',
            compact('categories')
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newCategoryAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('PhpbrAppBundle:Forum\Category')
            ->findAll()
        ;

        $category = new Category();

        $form = $this->createForm(new ForumCategoryFormType(), $category, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $category->setCreatedAt(new \DateTime());
            $category->setStatus(true);

            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_forum_categories'));
        }

        return $this->render('PhpbrAppBundle:Admin\Forum:new-category.html.twig', [
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PhpbrAppBundle:Forum\Category')->findOneBy(
            array(
                'id' => $id
            )
        );

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_forum_categories'));
    }

}


