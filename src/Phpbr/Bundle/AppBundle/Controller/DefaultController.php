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
        try {
            $params = array();

            if ($page == 'inicial') {
                $em = $this->getDoctrine()->getManager();

                $artigoRepo = $em->getRepository('PhpbrAppBundle:Artigo');
                $artigos = $artigoRepo->listaArtigosRecentes(10);

                $usuarios = $em->getRepository('PhpbrAppBundle:User')->listaUltimosUsuarios(5);
                $coles = $em->getRepository('PhpbrAppBundle:Cole')->listaColes(5);
                $forumMensagens = $em->getRepository('PhpbrAppBundle:Forum\Mensagem')->listaRecentes();

                $ircNicks = $this->pegaIrcNicks();

                $params = compact('artigos', 'usuarios', 'coles', 'forumMensagens', 'ircNicks');
            }

            return $this->render("PhpbrAppBundle:Default:{$page}.html.twig", $params);

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


    public function pegaIrcNicks(){
        $ircNicks = array();

        $em = $this->getDoctrine()->getManager();
        $nicks = $em->getRepository('PhpbrAppBundle:Irc')
            ->find(1);

        if ($nicks) {
            preg_match_all("/\\\"(.*?)\\\"/i", $nicks->getNicks(), $matches);

            if (count($matches[1]) > 0){
                $ircNicks = $matches[1];
            }
        }

        return $ircNicks;

    }
}


