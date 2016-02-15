<?php

namespace Phpbr\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\AppBundle\Entity\Article;

/**
 * Class ArticleApiService
 */
class ArticleApiService
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
     * Get Query
     *
     * @param $id
     * @return Article
     */
    public function getQueryBuilder($id)
    {
        $repository = $this->repository();

        $query = $repository->createQueryBuilder('Article')
            ->where('Article.id = :id')
            ->andWhere('Article.approved = :approved')
            ->setParameter('id', $id)
            ->setParameter('approved', true)
            ->getQuery();

        return $query;
    }
}
