<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{

    /**
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @todo Usar um render() ao inves de buscar os artigos aqui? (- performance / + organizacao).
     */
    public function pageAction($page) {
        $returnArtigos = array();

        try {
            if ($page == 'inicial') {
                $em = $this->getDoctrine()->getManager();
                $artigoRepo = $em->getRepository('PhpbrAppBundle:Artigo');

                $artigos = $artigoRepo->listaArtigosRecentes(10);

                $returnArtigos = compact('artigos');
            }

            return $this->render("PhpbrAppBundle:Default:{$page}.html.twig", $returnArtigos);

        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException;
        }
    }

}
