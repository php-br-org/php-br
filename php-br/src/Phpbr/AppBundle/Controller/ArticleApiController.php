<?php

namespace Phpbr\AppBundle\Controller;

use Phpbr\AppBundle\Services\ArticleApiService;
use Symfony\Component\HttpFoundation\Response;
use Phpbr\AppBundle\Entity\Article;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use GuzzleHttp\Client;


class ArticleApiController extends FOSRestController
{
    /**
     * Este método retorna dados de um artigo específico.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retorna dados do artigo requisitado.",
     * )
     */
    public function getArticleAction($id)
    {
        $query = $this->getArticleApiService()->getQueryBuilder($id);
        $article = $query->getOneOrNullResult();

        $response = new Response();
        $website = $this->container->getParameter('website');

        if (!$article) {
            $data = [
                'Erro' => 'phpbr.article.api.invalid'
            ];
        } else {
            $data = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'url' => 'http://' .$website. '/artigos/ler/' .$article->getSlug(),
                'author' => $article->getUser()->getName(),
                'published_at' => $article->getPublishedAt(),
                'approved_at' => $article->getApprovedAt()
            ];
        }

        $serializer = $this->get('jms_serializer');
        $response->setContent($serializer->serialize($data, 'json'));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response->send();
    }

    /**
     * Este método retorna a quantidade de comentarios feitos usando Discus para um artigo específico.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retorna a quantidade de comentários de um artigo.",
     * )
     */
    public function getNoCommentsAction($slug)
    {
        if (!$slug){
            return false;
        }

        $client = new Client([
            'base_url' => 'http://disqus.com'
        ]);

        $filter = [
            'query' => [
                'api_key'   => $this->container->getParameter('knp_disqus.api_key'),
                'forum'     => 'phpbrorg',
                'thread:link' => sprintf('http://%s/artigos/ler/%s',
                    $this->container->getParameter('website'),
                    $slug
                )
            ]
        ];

        try {
            $responseDiscus = $client->get('api/3.0/threads/details.json', $filter);
            $data = $responseDiscus->json();
        } catch (\Exception $e) {
            $data['response']['posts'] = 0;
            if ('400' == $e->getResponse()->getStatusCode()) {
                // die('Erro 400!');
            }
        }

        $qty = $data['response']['posts'];

        $response = new Response();
        $serializer = $this->get('jms_serializer');

        $response->setContent($serializer->serialize($qty, 'json'));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response->send();
    }

    /**
     * Get Article Api Service
     *
     * @return ArticleApiService
     */
    private function getArticleApiService()
    {
        return $this->get('phpbr_article_api_service_em');
    }
}


