<?php

namespace Phpbr\AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction() {
        return $this->render('PhpbrAppBundle:Admin:index.html.twig');
    }
}