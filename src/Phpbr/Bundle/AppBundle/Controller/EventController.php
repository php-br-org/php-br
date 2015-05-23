<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Phpbr\Bundle\AppBundle\Entity\Event;
use Phpbr\Bundle\AppBundle\Form\EventType;
use Pagerfanta\Pagerfanta;
use Phpbr\Bundle\AppBundle\Services\EventService;


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

            $data = $request->request->all();
            $day = $data['phpbr_bundle_appbundle_event']['day'];

            $date = new \DateTime(\DateTime::createFromFormat('d/m/Y', $day)->format('Y-m-d'));

            if($date === false) {
                throw new \Exception('Invalid Date');
            }

            $event->setDay($date);
            $event->setCreatedAt(new \DateTime());

            $this->getEventService()->insert($event);

            return $this->redirect(
                $this->generateUrl(
                    'phpbr_event_view', [
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
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PhpbrAppBundle:Event')->findBy(
            [ 'user' => $user ]
        );

        if (!$entities){
            throw $this->createNotFoundException('No events for this user');
        }

        return $this->render('PhpbrAppBundle:Event:view-my-events.html.twig', array(
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


    public function listMyEvents()
    {

    }

    public function deleteAction($id){
        $user = $this->get('security.context')->getToken()->getUser();

        if (gettype($user) != 'object') {
            return $this->redirect('/eventos');
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PhpbrAppBundle:Event')->findOneBy(
            array(
                'id' => $id,
                'user' => $user
            )
        );

        if (!$entity) {
            return $this->redirect($this->generateUrl('phpbr_list_my_events',
                array(
                    'erro' => 'Erro ao tentar deletar este evento. Ou ele não existe, ou você não tem permissão para excluí-lo'
                )
            ));
        }

        $em->remove($entity);
        $em->flush();

        $this->addFlash(
            'notice',
            'Evento excluído com sucesso!'
        );

        return $this->redirect($this->generateUrl('phpbr_list_my_events'));
    }

    public function editAction($id){

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
