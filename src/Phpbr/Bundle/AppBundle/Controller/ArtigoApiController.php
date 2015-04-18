<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Phpbr\Bundle\AppBundle\Entity\Artigo;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

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
        $repository = $this->getDoctrine()
            ->getRepository('PhpbrAppBundle:Artigo');

        $query = $repository->createQueryBuilder('Artigo')
            ->where('Artigo.id = :id')
            ->andWhere('Artigo.aprovado = :aprovado')
            ->setParameter('id', $id)
            ->setParameter('aprovado', true)
            ->getQuery();

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
}


