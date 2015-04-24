<?php

namespace Phpbr\Bundle\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\Bundle\AppBundle\Entity\Interfaces\ColeInterface;

/**
 * Class ColeService
 */
class ColeService {

    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Persist and flush cole
     *
     * @param ColeInterface $entity
     * @return ColeInterface
     */
    public function insert(ColeInterface $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function findByCole($id)
    {
        $entity = $this->em->getRepository('PhpbrAppBundle:Cole')->find($id);

        return $entity;
    }
}

