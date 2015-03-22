<?php

namespace Phpbr\Bundle\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\Bundle\AppBundle\Entity\Artigo;

class ArtigoController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listaAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $artigoRepo = $entityManager->getRepository('PhpbrAppBundle:Artigo');

        $artigos = $artigoRepo->listaAdminArtigos();

        return $this->render('PhpbrAppBundle:Admin\Artigo:lista.html.twig', compact('artigos'));
    }

    /**
     * @param Artigo $artigo
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function aprovarAction(Artigo $artigo, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $artigo->setAprovado(true);
        $artigo->setDataAutorizado(new \DateTime());
        $em->persist($artigo);
        $em->flush();

        $request->getSession()->getFlashBag()->add(
            'notice',
            'Artigo aprovado.'
        );

        return $this->redirect($this->generateUrl('admin_artigos'));
    }

    /**
     * @param Artigo $artigo
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function anularAction(Artigo $artigo, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $artigo->setAprovado(false);
        $em->persist($artigo);
        $em->flush();

        $request->getSession()->getFlashBag()->add(
            'notice',
            'Artigo anulado'
        );

        return $this->redirect($this->generateUrl('admin_artigos'));
    }
}
