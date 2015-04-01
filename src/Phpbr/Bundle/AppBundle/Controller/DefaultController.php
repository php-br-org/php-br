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

                $em = $this->getDoctrine()->getManager();
                $usuarios = $em->getRepository('PhpbrAppBundle:User')
                    ->findAll();
            }

            return $this->render("PhpbrAppBundle:Default:{$page}.html.twig", 
                array(
                    'artigos' => $artigos,
                    'usuarios' => $usuarios,
                )
            );

        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException;
        }
    }

    /**
     * @param $usuario
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function verUsuarioAction($usuario) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PhpbrAppBundle:User')->findOneBy(
            array(
                'username' => $usuario
            )
        );

        return $this->render("PhpbrAppBundle:Default:usuario.html.twig",
            array(
                'user' => $entity
            )
        );
    }

}
