<?php

namespace Phpbr\Bundle\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\Bundle\AppBundle\Entity\Artigo;

/**
 * Class ArtigoService
 */
class ArtigoService
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
     * Persist and flush article
     *
     * @param Artigo $entity
     * @return Artigo
     */
    public function insert(Artigo $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * Remove Article
     *
     * @param Artigo $artigo
     * @return Artigo
     */
    public function remove(Artigo $artigo)
    {
        $this->em->remove($artigo);
        $this->em->flush();

        return $artigo;
    }

    /**
     * Find all article
     *
     * @return array
     */
    public function findAll()
    {
        $article = $this->repository()->findAll();

        return $article;
    }

    /**
     * Find Article
     *
     * @param int $id
     * @return Artigo
     */
    public function findByArticle($id)
    {
        $id = $this->repository()->find([
            'id' => $id
        ]);

        return $id;
    }
}
