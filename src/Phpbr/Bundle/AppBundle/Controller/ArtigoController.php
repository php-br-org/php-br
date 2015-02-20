<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\Bundle\AppBundle\Entity\Artigo;
use Phpbr\Bundle\AppBundle\Form\Type\ArtigoFormType;

class ArtigoController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listmeusartigosAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $artigoRepo = $entityManager->getRepository('PhpbrAppBundle:Artigo');

        $usuario = $this->get('security.context')->getToken()->getUser();
        $artigos = $artigoRepo->listaArtigosUsuario($usuario);

        return $this->render('PhpbrAppBundle:Artigo:lista-meus-artigos.html.twig', compact('artigos'));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $artigoRepo = $entityManager->getRepository('PhpbrAppBundle:Artigo');

        $artigos = $artigoRepo->listaArtigosAtivos();

        return $this->render('PhpbrAppBundle:Artigo:lista.html.twig', compact('artigos'));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function novoAction(Request $request) {
        $artigo = new Artigo();
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ArtigoFormType(), $artigo, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $usuario = $this->get('security.context')->getToken()->getUser();
            $artigo->setUser($usuario);

            $entityManager->persist($artigo);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('lista_meus_artigos'));
        }

        return $this->render('PhpbrAppBundle:Artigo:novo.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editarAction($id) { 
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('PhpbrAppBundle:Artigo')->findOneBy(
            array(
                'id' => $id,
                'user' => $usuario->getId()
            )
        );

        if (!$entity) {
            throw $this->createNotFoundException('Erro. Este artigo não existe.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('PhpbrAppBundle:Artigo:editar.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Artigo entity.
    *
    * @param Artigo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Artigo $entity)
    {
        $form = $this->createForm(new ArtigoFormType(), $entity, array(
            'action' => $this->generateUrl('artigo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        // $form->add('submit', 'submit', array('label' => 'Atualizar'));

        return $form;
    }

    /**
     * Edits an existing Artigo entity.
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('PhpbrAppBundle:Artigo')->findOneBy(
            array(
                'id' => $id,
                'user' => $usuario->getId()
            )
        );

        if (!$entity) {
            throw $this->createNotFoundException('Erro! Este artigo não é editável!');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('artigo_edit', 
                array(
                    'id' => $id,
                    'sucesso' => true
                )
            ));
        }

        return $this->render('PhpbrAppBundle:Artigo:editar.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * @param Artigo $artigo
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lerAction(Artigo $artigo) {
        $email = $artigo->getUser()->getEmail();
        $gravatar = $this->get('gravatar');
        $imgGravatar = $gravatar->getGravatar($email, 150);

        return $this->render('PhpbrAppBundle:Artigo:ler.html.twig', 
            array_merge(
                compact('artigo'), 
                array('gravatar' => $imgGravatar)
            )
        );
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.context')->getToken()->getUser();

        if (gettype($usuario) != 'object') {
            return $this->redirect('/artigos');
        }

        $entity = $em->getRepository('PhpbrAppBundle:Artigo')->findOneBy(
            array(
                'id' => $id,
                'user' => $usuario->getId()
            )
        );

        if (!$entity) {
            return $this->redirect($this->generateUrl('lista_meus_artigos',
                array(
                    'erro' => 'Erro ao tentar deletar este artigo. Ou ele não existe, ou você não tem permissão para excluí-lo'
                )
            ));
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('lista_meus_artigos',
            array(
                'msg' => 'Artigo excluído com sucesso!'
            )
        ));
    }
}
