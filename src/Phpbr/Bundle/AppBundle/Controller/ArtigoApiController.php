<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Phpbr\Bundle\AppBundle\Services\ArtigoApiService;
use Symfony\Component\HttpFoundation\Response;
use Phpbr\Bundle\AppBundle\Entity\Artigo;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use GuzzleHttp\Client;


class ArtigoApiController extends FOSRestController 
{
    /**
     * Este método retorna dados de um artigo específico.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retorna dados do artigo requisitado.",
     * )
     */
    public function getArtigoAction($id)
    {
        $query = $this->getArtigoApiService()->getQueryBuilder($id);

        $artigo = $query->getOneOrNullResult();


        $response = new Response();
        $website = $this->container->getParameter('website');

        if (!$artigo) {
            $dados = [
                'Erro' => 'Este ID de artigo nao existe ou nao esta publicado'
            ];
        } else {
            $dados = [
                'id' => $artigo->getId(),
                'titulo' => $artigo->getTitulo(),
                'url' => 'http://' .$website. '/artigos/ler/' .$artigo->getSlug(),
                'autor' => $artigo->getUser()->getName(),
                'data_publicado' => $artigo->getDataPublicado(),
                'data_autorizado' => $artigo->getDataAutorizado()
            ];
        }

        $serializer = $this->get('jms_serializer');
        $response->setContent($serializer->serialize($dados, 'json'));
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
    public function getQuantidadeComentariosAction($slug)
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
                $dados = $responseDiscus->json();
            } catch (\Exception $e) {
                $dados['response']['posts'] = 0;
                if ('400' == $e->getResponse()->getStatusCode()) {
                    // die('Erro 400!');
                }
            }

        $quantidade = $dados['response']['posts'];

        $response = new Response();
        $serializer = $this->get('jms_serializer');
        $response->setContent($serializer->serialize($quantidade, 'json'));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response->send();

    }

    /**
     * Get Artigo Api Service
     *
     * @return ArtigoApiService
     */
    private function getArtigoApiService()
    {
        return $this->get('phpbr_artigo_api_service_em');
    }
}


