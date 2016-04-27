<?php

namespace Phpbr\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Phpbr\AppBundle\Entity\Forum\Topic;
use Phpbr\AppBundle\Entity\Forum\Category;
use Phpbr\AppBundle\Form\Type\ForumTopicFormType;

class TopicController extends Controller
{
    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('PhpbrAppBundle:Forum\Topic')
            ->find($id);

        return $this->render('PhpbrAppBundle:Forum:view.html.twig', array(
        ));
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewTopicAction($id)
    {
        $session = new Session();
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('PhpbrAppBundle:Forum\Category')
            ->find($id);

        $topics = $category->getTopics();
        $session->set('forumCategory', $category->getId());

        return $this->render('@PhpbrApp/Forum/view.html.twig', array(
            'category' => $category,
            'topics'   => $topics
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $topic = new Topic();
        $session = new Session();
        $em = $this->getDoctrine()->getManager();

        $categoryId = $session->get('forumCategory');
        $emCategory = $this->getDoctrine()->getManager();
        $category = $emCategory->getRepository('PhpbrAppBundle:Forum\Category')
            ->find($categoryId);

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(new ForumTopicFormType(), $topic, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $topic->setUser($user);

            $topic->setCategory($category);
            $topic->setCreatedAt(new \DateTime());

            $em->persist($topic);
            $em->flush();

            return $this->redirect($this->generateUrl('forum_view_message',
                array(
                    'slug_category' => $category->getSlug(),
                    'slug' => $topic->getSlug()
                )
            ));
        }

        return $this->render('PhpbrAppBundle:Forum:new.html.twig', array(
            'form' => $form->createView(),
            'category' => $category
        ));
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id)
    {
        return $this->render('PhpbrAppBundle:Forum:delete.html.twig', array(
                // ...
        ));    
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteTopicAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $topic = $em->getRepository('PhpbrAppBundle:Forum\Topic')
            ->findOneBy(
                array('id' => $id)
            );

        if (!$topic) {
            throw $this->createNotFoundException('Nao achou este topico!');
        }

        if ($topic->getUser() != $user){
            throw $this->createNotFoundException('Negado!');
        }

        $category = $topic->getCategory();

        $em->remove($topic);
        $em->flush();

        $this->addFlash(
            'notice',
            'Topic deletado com sucesso!'
        );

        return $this->redirect(
            $this->generateUrl(
                'forum_view_category',
                array(
                    'slug' => $category->getSlug()
                )
            )
        );
    }
}

