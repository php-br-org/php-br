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
        $artigoForm = new ArtigoFormType();
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm($artigoForm, $artigo, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $usuario = $this->get('security.context')->getToken()->getUser();
            $artigo->setUser($usuario);

            $entityManager->persist($artigo);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('lista_artigos'));
        }

        return $this->render('PhpbrAppBundle:Artigo:novo.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Artigo $artigo
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lerAction(Artigo $artigo) {
        return $this->render('PhpbrAppBundle:Artigo:ler.html.twig', compact('artigo'));
    }

}