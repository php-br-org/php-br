<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Phpbr\Bundle\AppBundle\Services\ArtigoService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\Bundle\AppBundle\Entity\Artigo;
use Phpbr\Bundle\AppBundle\Form\Type\ArtigoFormType;
use Pagerfanta\Pagerfanta;

/**
 * Class ArtigoController
 */
class ArtigoController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listaMeusArtigosAction(Request $request) {
        $artigoRepo = $this->getArtigoService()->repository();
        $usuario = $this->get('security.context')->getToken()->getUser();
        $artigosAdapter = $artigoRepo->listaArtigosUsuario($usuario);

        $artigos = new Pagerfanta($artigosAdapter);
        $artigos->setMaxPerPage($this->container->getParameter('artigos_por_pagina'));

        $pagina = $request->get('pagina', 1);
        $artigos->setCurrentPage($pagina);

        return $this->render('PhpbrAppBundle:Artigo:lista-meus-artigos.html.twig', compact('artigos'));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $artigoRepo = $this->getArtigoService()->repository();

        $artigosAdapter = $artigoRepo->listaArtigosAtivosAdapter();

        $artigos = new Pagerfanta($artigosAdapter);
        $artigos->setMaxPerPage($this->container->getParameter('artigos_por_pagina'));

        $pagina = $request->get('pagina', 1);
        $artigos->setCurrentPage($pagina);

        return $this->render('PhpbrAppBundle:Artigo:lista.html.twig', compact('artigos'));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function novoAction(Request $request) {
        $artigo = new Artigo();

        $form = $this->createForm(new ArtigoFormType(), $artigo, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $usuario = $this->get('security.context')->getToken()->getUser();
            $artigo->setUser($usuario);

            $this->getArtigoService()->insert($artigo);

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
        $usuario = $this->get('security.context')->getToken()->getUser();
        $id = $this->getArtigoService()->findByArticle($id);

        $entity = $this->getArtigoService()->repository()->findOneBy(
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
            $this->getArtigoService()->insert($entity);

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
        $usuario = $this->get('security.context')->getToken()->getUser();

        if (gettype($usuario) != 'object') {
            return $this->redirect('/artigos');
        }

        $id = $this->getArtigoService()->findByArticle($id);
        $entity = $this->getArtigoService()->repository()->findOneBy(
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

        $this->getArtigoService()->remove($entity);

        return $this->redirect($this->generateUrl('lista_meus_artigos',
            array(
                'msg' => 'Artigo excluído com sucesso!'
            )
        ));
    }

    /**
     * Get Artigo Service
     *
     * @return ArtigoService
     */
    private function getArtigoService()
    {
        return $this->get('phpbr_artigo_service_em');
    }
}
