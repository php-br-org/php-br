<?php

namespace Phpbr\AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Phpbr\AppBundle\Entity\Forum\Mensagem;

class ForumMensagemExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'quantidade_mensagens',
                array (
                    $this,
                    'getQuantidadeMensagens'
                )
            )
        );
    }

    public function getQuantidadeMensagens($categoria_id) {
        $return = $this->em->createQueryBuilder()
            ->select('COUNT(m)')
            ->from('Phpbr\AppBundle\Entity\Forum\Mensagem', 'm')
            ->leftJoin('m.topico', 't')
            ->leftJoin('t.categoria', 'c')
            ->where('c.id = :categoria')
            ->setParameter('categoria', $categoria_id)
            ->getQuery()
            ->getOneOrNullResult();

        return (int) $return[1];
    }

    public function getName() {
        return 'quantidade_mensagens';
    }
}

