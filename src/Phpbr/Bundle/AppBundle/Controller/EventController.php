<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Phpbr\Bundle\AppBundle\Entity\Event;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    /**
     * Lists all events.
     *
     */
    public function viewAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PhpbrAppBundle:Event')->findAll();

        return $this->render('PhpbrAppBundle:Event:index.html.twig', array(
            'entities' => $entities,
        ));
    }



    /**
     * View a specific event.
     *
     */
    public function viewAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhpbrAppBundle:Event')->findOneBy([
            'slug' => $slug
        ]);

        return $this->render('PhpbrAppBundle:Event:view.html.twig', array(
            'entity' => $entity,
        ));
    }
}
