<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Phpbr\Bundle\AppBundle\Entity\Irc;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class IrcApiController extends FOSRestController
{
    /**
     * Este método atualiza a lista de usuarios online no IRC ##php-br.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Quem chama este method eh o IRC BOT: php-br",
     * )
     */
    public function putIrcAction($nicks)
    {
        $repository = $this->getDoctrine()
            ->getRepository('PhpbrAppBundle:Irc');

        $irc = $repository->findById(1);
        if (!$irc){
            $em = $this->getDoctrine()->getManager();
            $irc = new Irc();
        }

        if (!$nicks) {
            $dados = [
                'Erro'   => 'Lista de nicks vazia',
                'status' => 'FAIL'
            ];
        } else {
            $dados = [
                'nicks' => $nicks,
                'status' => 'OK'
            ];

            $irc->setNicks($nicks);
            $em->persist($irc);
            $em->flush();
        }

        $response = new Response();
        $serializer = $this->get('jms_serializer');
        $response->setContent($serializer->serialize($dados, 'json'));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response->send();
    }


    /**
     * Este método retorna os nicks do canal ##php-br
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Retorna os nicks ou fail. Confira o status.",
     * )
     */
    public function getNicksAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nicks = $em->getRepository('PhpbrAppBundle:Irc')
            ->findById(1);

        if (!$nicks) {
            $dados = [
                'Erro' => 'Nao foi possivel ler os nicks do canal',
                'status' => 'FAIL'
            ];
        } else {
            $dados = [
                'status' => 'OK',
                'nicks' => $nicks->getNicks(),
                'ultima_atualizacao' => $nicks->getDataAtualizado()
            ];
        }

        $response = new Response();
        $serializer = $this->get('jms_serializer');
        $response->setContent($serializer->serialize($dados, 'json'));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response->send();

    }
}


