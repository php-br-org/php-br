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
    public function listaForumMensagensAdapter() {
        $query = $this->createQueryBuilder('forum_mensagens')
            ->orderBy('forum_mensagens.id', 'DESC');
        $pagerfantaAdapter = new DoctrineORMAdapter($query);
        return $pagerfantaAdapter;
    }
}
