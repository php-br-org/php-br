<?php

namespace Phpbr\Bundle\AppBundle\Controller;

use Phpbr\Bundle\AppBundle\Services\DefaultService;
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
                $artigoRepo = $this->getDefaultService()->repository();
                $artigos = $artigoRepo->listaArtigosRecentes(10);

                $usuarios = $this->getDefaultService()->listaUltimosUsuarios(5);
                $coles = $this->getDefaultService()->listaColes(5);
                $forumMensagens = $this->getDefaultService()->forumMensagens();

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

        $entity = $this->getDefaultService()->findOneByUser($usuario);

        return $this->render("PhpbrAppBundle:Default:usuario.html.twig",
            array(
                'user' => $entity
            )
        );
    }


    private function pegaIrcNicks(){
        $ircNicks = array();

        $nicks = $this->getDefaultService()->ircNick(1);

        if ($nicks) {
            preg_match_all("/\\\"(.*?)\\\"/i", $nicks->getNicks(), $matches);

            if (count($matches[1]) > 0){
                $ircNicks = $matches[1];
            }
        }

        return $ircNicks;

    }

    /**
     * Get Default Service
     *
     * @return DefaultService
     */
    private function getDefaultService()
    {
        return $this->get('phpbr_default_service_em');
    }
}


