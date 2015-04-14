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
        $em = $this->getDoctrine()->getManager();
        $artigo = $em->getRepository('PhpbrAppBundle:Artigo')->find($id);

        $website = $this->container->getParameter('website');

        $dados = array(
            'id' => $artigo->getId(),
            'titulo' => $artigo->getTitulo(),
            'url' => 'http://' .$website. '/artigos/ler/' .$artigo->getSlug(),
            'data_publicado' => $artigo->getDataPublicado(),
        );

        $serializer = $this->get('jms_serializer');
        $response = new Response();

        $response->setContent($serializer->serialize($dados, 'json'));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response->send();
    }
}


