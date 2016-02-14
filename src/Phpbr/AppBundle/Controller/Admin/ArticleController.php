<?php

namespace Phpbr\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\AppBundle\Entity\Artigo;

class ArticleController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $articleRepo = $entityManager->getRepository('PhpbrAppBundle:Article');

        $articles = $articleRepo->listArticlesAdmin();

        return $this->render('PhpbrAppBundle:Admin\Article:list.html.twig', compact('articles'));
    }

    /**
     * @param Article $article
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function approveAction(Article $article, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $article->setApproved(true);
        $article->setApprovedAt(new \DateTime());
        $em->persist($article);
        $em->flush();

        $request->getSession()->getFlashBag()->add(
            'notice',
            'Artigo aprovado.'
        );

        return $this->redirect($this->generateUrl('admin_articles'));
    }

    /**
     * @param Article $article
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function refuseAction(Article $article, Request $request) {
        $em = $this->getDoctrine()->getManager();

        $article->setApproved(false);
        $em->persist($article);
        $em->flush();

        $request->getSession()->getFlashBag()->add(
            'notice',
            'Artigo anulado'
        );

        return $this->redirect($this->generateUrl('admin_articles'));
    }
}


