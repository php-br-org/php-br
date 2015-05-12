<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Phpbr\Bundle\AppBundle\Entity\Event;
use Phpbr\Bundle\AppBundle\Form\EventType;
use Phpbr\Bundle\AppBundle\Services\EventService;
use Pagerfanta\Pagerfanta;


/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    /**
     * New event.
     *
     */
    public function newAction(Request $request)
    {
        $event = new Event();

        $form = $this->createForm(new EventType(), $event, array());
        $form->handleRequest($request);
        $user = $this->get('security.context')->getToken()->getUser();

        if(!$this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            return new RedirectResponse($this->generateUrl('fos_user_security_login'));
        }

        if ($form->isValid()) {
            $event->setUser($user);
            $event->setCreatedAt(new \DateTime());

            $this->getEventService()->insert($event);

            return $this->redirect(
                $this->generateUrl(
                    'phpbr_list_my_events', [
                        'slug' => $event->getSlug()
                    ]
                )
            );
        }

        $entities = $this->getDoctrine()->getManager()->getRepository('PhpbrAppBundle:Event')->findAll();

        return $this->render('PhpbrAppBundle:Event:new.html.twig', array(
            'form' => $form->createView(),
            'entities' => $entities
        ));
    }


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
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listMyEventsAction(Request $request) {
        $eventRepo = $this->getEventService()->repository();
        $user = $this->get('security.context')->getToken()->getUser();
        $eventAdapter = $eventRepo->listUsersEvent($user);

        $events = new Pagerfanta($eventAdapter);
        $events->setMaxPerPage($this->container->getParameter('events_per_page'));

        $pagina = $request->get('pagina', 1);
        $events->setCurrentPage($pagina);

        return $this->render('PhpbrAppBundle:Event:list-my-events.html.twig', compact('events'));
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


    public function listMyEvents()
    {

    }


    /**
     * Get Event Service
     *
     * @return EventService
     */
    private function getEventService()
    {
        return $this->get('phpbr_event_service_em');
    }



}
