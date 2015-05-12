<?php

namespace Phpbr\Bundle\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\Bundle\AppBundle\Entity\Artigo;

/**
 * Class ArtigoApiService
 */
class ArtigoApiService
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
     * Get Query
     *
     * @param $id
     * @return Artigo
     */
    public function getQueryBuilder($id)
    {
        $repository = $this->repository();

        $query = $repository->createQueryBuilder('Artigo')
            ->where('Artigo.id = :id')
            ->andWhere('Artigo.aprovado = :aprovado')
            ->setParameter('id', $id)
            ->setParameter('aprovado', true)
            ->getQuery();

        return $query;
    }
}
