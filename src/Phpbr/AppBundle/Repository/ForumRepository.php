<?php

namespace Phpbr\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;


class ForumRepository extends EntityRepository
{
    /**
     * Retorna Adapter para pagerfanta (paginacao)
     *
     * @return DoctrineORMAdapter
     */
    public function listForumMessagesAdapter() {
        $query = $this->createQueryBuilder('forum_messages')
            ->orderBy('forum_messages.id', 'DESC');

        $pagerfantaAdapter = new DoctrineORMAdapter($query);

        return $pagerfantaAdapter;
    }
}
