<?php

namespace Phpbr\Bundle\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ForumMensagemRepository extends EntityRepository
{
    /**
     * @param int $qte
     *
     * @return array
     */
    public function listaRecentes($qte = 10) {
        $query = $this->createQueryBuilder('Mensagem')
            ->orderBy('Mensagem.dataCriacao', 'DESC');

        if (is_numeric($qte)) $query->setMaxResults($qte);

        return $query->getQuery()->getResult();
    }

}
