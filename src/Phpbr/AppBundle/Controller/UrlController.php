<?php

namespace Phpbr\AppBundle\Controller;

use Phpbr\AppBundle\Services\UrlService;
use Phpbr\AppBundle\Entity\Url;
use Phpbr\AppBundle\Form\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Url controller.
 *
 */
class UrlController extends Controller
{

    /**
     * Lists all Url entities.
     *
     */
    public function indexAction()
    {
        $entities = $this->getUrlService()->findAll();

        return $this->render('PhpbrAppBundle:Url:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Url entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Url();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getUrlService()->insert($entity);

            return $this->redirect($this->generateUrl('url_show', array('id' => $entity->getId())));
        }

        return $this->render('PhpbrAppBundle:Url:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Url entity.
     *
     * @param Url $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Url $entity)
    {
        $form = $this->createForm(new UrlType(), $entity, array(
            'action' => $this->generateUrl('url_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Url entity.
     *
     */
    public function newAction()
    {
        $entity = new Url();
        $form   = $this->createCreateForm($entity);

        return $this->render('PhpbrAppBundle:Url:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Url entity.
     *
     */
    public function showAction($id)
    {
        $entity = $this->getUrlService()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Url entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PhpbrAppBundle:Url:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Url entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->getUrlService()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Url entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PhpbrAppBundle:Url:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Url entity.
    *
    * @param Url $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Url $entity)
    {
        $form = $this->createForm(new UrlType(), $entity, array(
            'action' => $this->generateUrl('url_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Url entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getUrlService()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Url entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->getUrlService()->insert($entity);

            return $this->redirect($this->generateUrl('url_edit', array('id' => $id)));
        }

        return $this->render('PhpbrAppBundle:Url:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Url entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->getUrlService()->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Url entity.');
            }

            $this->getUrlService()->delete($entity);

        }

        return $this->redirect($this->generateUrl('url'));
    }

    /**
     * Creates a form to delete a Url entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('url_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Get Url Service
     *
     * @return UrlService
     */
    private function getUrlService()
    {
        return $this->get('phpbr_url_service_em');
    }
}
