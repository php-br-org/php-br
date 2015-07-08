<?php

namespace Phpbr\Bundle\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\Bundle\AppBundle\Entity\Url;

/**
 * Class UrlService
 * @package Phpbr\Bundle\AppBundle\Services
 */
class UrlService
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
     * @return Url
     */
    public function repository()
    {
        $url = $this->em->getRepository('PhpbrAppBundle:Url');

        return $url;
    }

    /**
     * Persist and flush url
     *
     * @param Url $entity
     * @return Url
     */
    public function insert(Url $entity)
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
