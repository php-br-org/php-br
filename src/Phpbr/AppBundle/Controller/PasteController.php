<?php

namespace Phpbr\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Phpbr\AppBundle\Entity\Paste;
use Phpbr\AppBundle\Form\Type\PasteType;
use Pagerfanta\Pagerfanta;
use Phpbr\AppBundle\Services\PasteService;

/**
 * Paste controller.
 *
 */
class PasteController extends Controller
{

    /**
     * Lists all Paste entities.
     *
     */
    public function indexAction(Request $request)
    {
        $entity = new Paste();
        $session = new Session();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getPasteService()->insert($entity);

            $session->set('deleteKey', $entity->getDeleteKey());

            return $this->redirect($this->generateUrl('paste_see',
                array(
                    'id' => $entity->getId(),
                )
            ));
        }

        $pasteService = $this->get('phpbr_paste_service_em');
        $pasteRepo = $pasteService->em->getRepository('PhpbrAppBundle:Paste')->listPastesAdapter();

        $pastes = new Pagerfanta($pasteRepo);
        $pastes->setMaxPerPage($this->container->getParameter('pastes_per_page'));

        $page = $request->get('pagina', 1);
        $pastes->setCurrentPage($page);

        return $this->render('PhpbrAppBundle:Paste:index.html.twig', array(
            'entities' => $pastes,
            'form'     => $form->createView()
        ));
    }


    /**
     * Creates a new Paste entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Paste();
        $session = new Session();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getPasteService()->insert($entity);

            $session->set('deleteKey', $entity->getDeleteKey());

            return $this->redirect($this->generateUrl('paste_see', 
                array(
                    'id' => $entity->getId(),
                )
            ));
        }

        return $this->render('PhpbrAppBundle:Paste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Paste entity.
     *
     * @param Paste $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Paste $entity)
    {
        $form = $this->createForm(new PasteType(), $entity, array(
            'action' => $this->generateUrl('paste_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Paste entity.
     *
     */
    public function newAction()
    {
        $entity = new Paste();
        $form   = $this->createCreateForm($entity);

        return $this->render('PhpbrAppBundle:Paste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Paste entity.
     *
     */
    public function viewAction($id)
    {
        $entity = $this->getPasteService()->findByPaste($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $geshi = new \GeSHi($entity->getCode(), $entity->getType());
        $code = $geshi->parse_code();

        return $this->render('PhpbrAppBundle:Paste:view.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'code'        => $code,
        ));
    }

    /**
     * Finds and displays a Paste entity RAW.
     *
     */
    public function viewRawAction($id)
    {
        $entity = $this->getPasteService()->findByPaste($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paste entity.');
        }

        $code = htmlspecialchars_decode($entity->getCode());

        $response = new Response( 
            $this->renderView('PhpbrAppBundle:Paste:viewRaw.html.twig', array(
                'code' => $code,
            ), 200)
        );

        $response->headers->set('Content-Type', 'text/plain');
        return $response;
    }

    /**
     * Displays a form to edit an existing Paste entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->getPasteService()->findByPaste($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paste entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PhpbrAppBundle:Paste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Paste entity.
    *
    * @param Paste $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Paste $entity)
    {
        $form = $this->createForm(new PasteType(), $entity, array(
            'action' => $this->generateUrl('paste_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Paste entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getPasteService()->findByPaste($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->getPasteService()->insert($entity);

            return $this->redirect($this->generateUrl('paste_edit', array('id' => $id)));
        }

        return $this->render('PhpbrAppBundle:Paste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Paste entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $pasteService = $this->get('phpbr_paste_service_em');
            $entity = $pasteService->em->getRepository('PhpbrAppBundle:Paste')->findOneBy(
                array(
                    'id' => $id
                )
            );

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paste entity.');
            }

            $pasteService->em->remove($entity);
            $pasteService->em->flush();
        }

        return $this->redirect($this->generateUrl('paste'));
    }

    /**
     * Creates a form to delete a Paste entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paste_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Get Paste Service
     *
     * @return PasteService
     */
    private function getPasteService()
    {
        return $this->get('phpbr_paste_service_em');
    }
}
