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
     * @return Article
     */
    public function repository()
    {
        $article = $this->em->getRepository('PhpbrAppBundle:Article');

        return $article;
    }

    /**
     * Get Repository
     *
     * @return listMostRecentUsers
     */
    public function listMostRecentUsers($qtd)
    {
        $recentUsers = $this->em->getRepository('PhpbrAppBundle:User')->listMostRecentUsers($qtd);

        return $recentUsers;
    }

    /**
     * Get Repository
     *
     * @return listPastes
     */
    public function listPastes($qtd)
    {
        $pastes = $this->em->getRepository('PhpbrAppBundle:Paste')->listPastes($qtd);

        return $pastes;
    }

    /**
     * Get Repository
     *
     * @return forumMessages
     */
    public function forumMessages()
    {
        $messages = $this->em->getRepository('PhpbrAppBundle:Forum\Message')->listRecentMessages();

        return $messages;
    }

    /**
     * Get Repository
     *
     * @param $user
     * @return object
     */
    public function findOneByUser($user)
    {
        $user = $this->em->getRepository('PhpbrAppBundle:User')->findOneBy([
                'username' => $user
            ]
        );

        return $user;
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