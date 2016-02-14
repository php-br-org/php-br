<?php
namespace Phpbr\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoryController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('PhpbrAppBundle:Forum\Category')->findAll();

        return $this->render('PhpbrAppBundle:Forum:index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @param $category
     */
    public function categoryLastTwoMessages($category)
    {
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository('PhpbrAppBundle:Forum\Message')
            ->findAll();
    }

    /**
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewCategoryAction($slug)
    {
        $session = new Session();
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('PhpbrAppBundle:Forum\Category')
            ->findOneBy(array(
                'slug' => $slug
            ));

        $topics = $category->getTopics();
        $session->set('forumCategory', $category->getId());

        return $this->render('@PhpbrApp/Forum/view.html.twig', array(
            'category' => $category,
            'topics'   => $topics
        ));
    }
}