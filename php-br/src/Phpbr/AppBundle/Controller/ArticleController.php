<?php

namespace Phpbr\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Phpbr\AppBundle\Services\ArticleService;
use Phpbr\AppBundle\Entity\Article;
use Phpbr\AppBundle\Form\Type\ArticleFormType;
use Pagerfanta\Pagerfanta;

/**
 * Class ArticleController
 */
class ArticleController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listMyArticlesAction(Request $request) {
        $articleRepo = $this->getArticleService()->repository();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $articlesAdapter = $articleRepo->listUserArticles($user);

        $articles = new Pagerfanta($articlesAdapter);
        $articles->setMaxPerPage($this->container->getParameter('articles_per_page'));

        $page = $request->get('page', 1);
        $articles->setCurrentPage($page);

        return $this->render('PhpbrAppBundle:Article:list-my-articles.html.twig', compact('articles'));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $articleRepo = $this->getArticleService()->repository();

        $articlesAdapter = $articleRepo->listActiveArticlesAdapter();

        $articles = new Pagerfanta($articlesAdapter);
        $articles->setMaxPerPage($this->container->getParameter('articles_per_page'));

        $page = $request->get('page', 1);
        $articles->setCurrentPage($page);

        return $this->render('PhpbrAppBundle:Article:list.html.twig', compact('articles'));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request) {
        $article = new Article();

        $form = $this->createForm(new ArticleFormType(), $article, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $article->setUser($user);

            $this->getArticleService()->insert($article);

            return $this->redirect($this->generateUrl('list_my_articles'));
        }

        return $this->render('PhpbrAppBundle:Article:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id) {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $this->getArticleService()->findByArticle($id);

        $entity = $this->getArticleService()->repository()->findOneBy(
            array(
                'id' => $id,
                'user' => $user->getId()
            )
        );

        if (!$entity) {
            throw $this->createNotFoundException('phpbr.article.not_found');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('PhpbrAppBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Article entity.
    *
    * @param Article $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Article $entity)
    {
        $form = $this->createForm(new ArticleFormType(), $entity, array(
            'action' => $this->generateUrl('article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Article entity.
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entity = $em->getRepository('PhpbrAppBundle:Article')->findOneBy(
            array(
                'id' => $id,
                'user' => $user->getId()
            )
        );

        if (!$entity) {
            throw $this->createNotFoundException('phpbr.article.not_editable');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->getArticleService()->insert($entity);

            return $this->redirect($this->generateUrl('article_edit',
                array(
                    'id' => $id,
                    'success' => true
                )
            ));
        }

        return $this->render('PhpbrAppBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * @param Article $article
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readAction(Article $article) {
        $email = $article->getUser()->getEmail();
        $gravatar = $this->get('gravatar');
        $imgGravatar = $gravatar->getGravatar($email, 150);

        return $this->render('PhpbrAppBundle:Article:read.html.twig',
            array_merge(
                compact('article'),
                array('gravatar' => $imgGravatar)
            )
        );
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (gettype($user) != 'object') {
            return $this->redirect($this->generateUrl('list_articles'));
        }

        $id = $this->getArticleService()->findByArticle($id);
        $entity = $this->getArticleService()->repository()->findOneBy(
            array(
                'id' => $id,
                'user' => $user->getId()
            )
        );

        if (!$entity) {
            return $this->redirect($this->generateUrl('list_my_articles',
                array(
                    'error' => 'phpbr.article.error_deleting'
                )
            ));
        }

        $this->getArticleService()->remove($entity);

        return $this->redirect($this->generateUrl('list_my_articles',
            array(
                'msg' => 'phpbr.article.removed'
            )
        ));
    }

    /**
     * Get Article Service
     *
     * @return ArticleService
     */
    private function getArticleService()
    {
        return $this->get('phpbr_article_service_em');
    }
}
