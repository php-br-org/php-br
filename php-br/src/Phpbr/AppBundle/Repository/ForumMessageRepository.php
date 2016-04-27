<?php

namespace Phpbr\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ForumMessageRepository extends EntityRepository
{
    /**
     * @param int $qty
     *
     * @return array
     */
    public function listRecentMessages($qty = 10) {
        $query = $this->createQueryBuilder('Message')
            ->orderBy('Message.createdAt', 'DESC');

        if (is_numeric($qty)) $query->setMaxResults($qty);

        return $query->getQuery()->getResult();
    }

}
