<?php

namespace Phpbr\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\AppBundle\Entity\Irc;

/**
 * Class UrlService
 * @package Phpbr\AppBundle\Services
 */
class IrcApiService
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
     * @return Irc
     */
    public function repository()
    {
        $url = $this->em->getRepository('PhpbrAppBundle:Irc');

        return $url;
    }

    /**
     * Persist and flush irc
     *
     * @param Irc $entity
     * @return Irc
     */
    public function insert(Irc $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * Remove Url
     *
     * @param Url $url
     * @return Url
     */
    public function delete(Url $url)
    {
        $this->em->remove($url);
        $this->em->flush();

        return $url;
    }

    /**
     * Find all url
     *
     * @return array
     */
    public function findAll()
    {
        $url = $this->repository()->findAll();

        return $url;
    }

    /**
     * Find url
     *
     * @param int $id
     * @return Url
     */
    public function find($id)
    {
        $id = $this->repository()->find($id);

        return $id;
    }
}
