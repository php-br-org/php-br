<?php

namespace Phpbr\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DefaultService
 */
class DefaultService
{
    public $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Get Repository
     *
     * @return Artigo
     */
    public function repository()
    {
        $article = $this->em->getRepository('PhpbrAppBundle:Artigo');

        return $article;
    }

    /**
     * Get Repository
     *
     * @return listaUltimosUsuarios
     */
    public function listaUltimosUsuarios($qtd)
    {
        $listaUltimosUsuarios = $this->em->getRepository('PhpbrAppBundle:User')->listaUltimosUsuarios($qtd);

        return $listaUltimosUsuarios;
    }

    /**
     * Get Repository
     *
     * @return listaColes
     */
    public function listaColes($qtd)
    {
        $listaColes = $this->em->getRepository('PhpbrAppBundle:Cole')->listaColes($qtd);

        return $listaColes;
    }

    /**
     * Get Repository
     *
     * @return forumMensagens
     */
    public function forumMensagens()
    {
        $forumMensagens = $this->em->getRepository('PhpbrAppBundle:Forum\Mensagem')->listaRecentes();

        return $forumMensagens;
    }

    /**
     * Get Repository
     *
     * @param $usuario
     * @return object
     */
    public function findOneByUser($usuario)
    {
        $usuario = $this->em->getRepository('PhpbrAppBundle:User')->findOneBy([
                'username' => $usuario
            ]
        );

        return $usuario;
    }

    /**
     * Get Repository
     *
     * @return nick
     */
    public function ircNick($qtd)
    {
        $nick = $this->em->getRepository('PhpbrAppBundle:Irc')->find($qtd);

        return $nick;
    }

}