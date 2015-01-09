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
     */
    public function pageAction($page) {
        try {
            return $this->render("PhpbrAppBundle:Default:{$page}.html.twig");
        } catch (\InvalidArgumentException $e) {
            throw new NotFoundHttpException;
        }
    }

}
