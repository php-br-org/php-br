<?php
namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class CategoriaController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('PhpbrAppBundle:Forum\Categoria')->findAll();

        return $this->render('PhpbrAppBundle:Forum:index.html.twig', array(
            'categorias' => $categorias
        ));
    }

    public function categoria2ultimaMensagem($categoria)
    {
        $em = $this->getDoctrine()->getManager();
        $mensagem = $em->getRepository('PhpbrAppBundle:Forum\Mensagem')
            ->findAll();
    }
}