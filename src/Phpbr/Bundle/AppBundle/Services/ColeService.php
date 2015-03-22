<?php

namespace Phpbr\Bundle\AppBundle\Services;

use Doctrine\ORM\EntityManager;

class ColeService {

    /**
     *
     * @var EntityManager
     */
    public $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
}

