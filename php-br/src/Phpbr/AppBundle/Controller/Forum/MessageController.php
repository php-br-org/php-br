<?php

namespace Phpbr\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\AppBundle\Form\Type\ForumMessageFormType;
use Phpbr\AppBundle\Entity\Forum\Topic;
use Phpbr\AppBundle\Entity\Forum\Category;
use Phpbr\AppBundle\Entity\Forum\Message;

class MessageController extends Controller
{

    /**
     * @param Topic $topic
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewMessageAction(Topic $topic, Request $request)
    {
        $message = new Message();
        $form = $this->createForm(new ForumMessageFormType(), $message, array());
        $form->handleRequest($request);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $topic_id = $topic->getId();

        if ($form->isValid()) {
            $message->setUser($user);
            $message->setTopic($topic);
            $message->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $topic = $em->getRepository('PhpbrAppBundle:Forum\Topic')
                ->find($topic_id);
        }

        if ('anon.' == $user) {
            $form = $this->createForm(new ForumMessageFormType(), $message, array(
                'disabled' => true
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('PhpbrAppBundle:Forum\Message')
            ->findBy(
                array('topic' => $topic)
            );

        return $this->render('PhpbrAppBundle:Forum:viewMessage.html.twig', array(
            'topic' => $topic,
            'form' => $form->createView(),
            'messages' => $messages,
            'user' => $user
        ));
    }

    /**
     * @param $topic_id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newMessageAction($topic_id)
    {
        return $this->render('PhpbrAppBundle:Forum:newMessage.html.twig', array(
                // ...
        ));
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteMessageAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $message = $em->getRepository('PhpbrAppBundle:Forum\Message')
            ->findOneBy(
                array('id' => $id)
            );

        if (!$message) {
            throw $this->createNotFoundException('Unable to find message entity.');
        }

        if ($message->getUser() != $user) {
            throw $this->createNotFoundException('Unable to find message entity.');
        }

        $topic = $message->getTopic();

        $em->remove($message);
        $em->flush();

        $this->addFlash(
            'notice',
            'Mensagem deletada com sucesso!'
        );

        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('PhpbrAppBundle:Forum\Message')
            ->findBy(
                array('topic' => $topic)
            );

        $message = new Message();
        $form = $this->createForm(new ForumMessageFormType(), $message, array());

        return $this->redirect(
            $this->generateUrl(
                'forum_view_message',
                array(
                    'slug_category' => $topic->getCategory()->getSlug(),
                    'slug' => $topic->getSlug()
                )
            )
        );
    }

    /**
     * @param $category_id
     *
     * @return mixed
     */
    public function topicsTwoLastMessages($category_id)
    {
        $em = $this->getDoctrine()->getManager();
        $lastTopic = $em->getRepository('PhpbrAppBundle:Forum\Topic')
            ->findBy(
                array('category' => $category_id),
                array('id' => 'DESC'),
                1
            );

        return $lastTopic;
    }

}

