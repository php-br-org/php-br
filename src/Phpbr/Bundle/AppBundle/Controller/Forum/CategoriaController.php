<?php
namespace Phpbr\Bundle\AppBundle\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class CategoriaController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categorias = $em->getRepository('PhpbrAppBundle:Forum\Categoria')->findAll();

        return $this->render('PhpbrAppBundle:Forum:index.html.twig', array(
            'categorias' => $categorias
        ));
    }

    /**
     * @param $categoria
     */
    public function categoria2ultimaMensagem($categoria)
    {
        $em = $this->getDoctrine()->getManager();
        $mensagem = $em->getRepository('PhpbrAppBundle:Forum\Mensagem')
            ->findAll();
    }

    /**
     * @param $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function verCategoriaAction($slug)
    {
        $session = new Session();
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('PhpbrAppBundle:Forum\Categoria')
            ->findOneBy(array(
                'slug' => $slug
            ));

        $topicos = $categoria->getTopicos();
        $session->set('forumCategoria', $categoria->getId());

        return $this->render('@PhpbrApp/Forum/ver.html.twig', array(
            'categoria' => $categoria,
            'topicos'   => $topicos
        ));
    }
}