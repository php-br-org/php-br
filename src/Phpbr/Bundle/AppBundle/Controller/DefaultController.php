<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Phpbr\Bundle\AppBundle\Entity\Artigo;

class DefaultController extends Controller
{

    /**
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pageAction($page) {
        $returnArtigos = array();
        try {
            if ($page == 'inicial') {
                $em = $this->getDoctrine()->getManager();
                $artigoRepo = $em->getRepository('PhpbrAppBundle:Artigo');

                $artigos = $artigoRepo->listaArtigosAtivos();

        $email = $artigos->getUser()->getEmail();
        $gravatar = $this->get('gravatar');
        $imgGravatar = $gravatar->getGravatar($email, 150);

                $returnArtigos = compact('artigos');
            }

            return $this->render("PhpbrAppBundle:Default:{$page}.html.twig", $returnArtigos);

        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException;
        }
    }

}
