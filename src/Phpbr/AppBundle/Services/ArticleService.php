<?php

namespace Phpbr\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\AppBundle\Entity\Article;

/**
 * Class ArticleService
 */
class ArticleService
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
     * Persist and flush article
     *
     * @param Article $entity
     * @return Article
     */
    public function insert(Article $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * Remove Article
     *
     * @param Article $article
     * @return Article
     */
    public function remove(Article $article)
    {
        $this->em->remove($article);
        $this->em->flush();

        return $article;
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
     * @return Article
     */
    public function findByArticle($id)
    {
        $id = $this->repository()->find([
            'id' => $id
        ]);

        return $id;
    }
}
