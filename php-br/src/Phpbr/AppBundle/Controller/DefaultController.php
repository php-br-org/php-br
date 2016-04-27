<?php

namespace Phpbr\AppBundle\Controller;

use Phpbr\AppBundle\Services\DefaultService;
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

            if ('main' == $page) {
                $articleRepo = $this->getDefaultService()->repository();
                $articles = $articleRepo->listRecentArticles(10);

                $users = $this->getDefaultService()->listMostRecentUsers(5);
                $pastes = $this->getDefaultService()->listPastes(5);
                $forumMessages = $this->getDefaultService()->forumMessages();

                $ircNicks = $this->fetchIRCNicks();

                $params = compact('articles', 'users', 'pastes', 'forumMessages', 'ircNicks');
            }

            if ('whoweare' == $page) {
                $client = new \Github\Client();
                $contributors = $client->api('repo')->contributors('php-br-org', 'php-br');
                $params = compact('contributors');
            }

            return $this->render("PhpbrAppBundle:Default:{$page}.html.twig", $params);

        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException;
        }
    }

    /**
     * @param $user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function viewUserAction($user) {

        $entity = $this->getDefaultService()->findOneByUser($user);

        return $this->render("PhpbrAppBundle:Default:user.html.twig",
            array(
                'user' => $entity
            )
        );
    }

    /**
     * @return array
     */
    private function fetchIRCNicks(){
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


