<?php

namespace Phpbr\AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Phpbr\AppBundle\Entity\Interfaces\PasteInterface;

/**
 * Class PasteService
 */
class PasteService {

    /**
     * @var EntityManagerInterface $em
     */
    public $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Persist and flush cole
     *
     * @param PasteInterface $entity
     * @return PasteInterface
     */
    public function insert(PasteInterface $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function findByPaste($id)
    {
        $entity = $this->em->getRepository('PhpbrAppBundle:Paste')->find($id);

        return $entity;
    }
}

