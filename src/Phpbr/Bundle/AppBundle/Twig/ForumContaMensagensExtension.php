<?php

namespace Phpbr\Bundle\AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem;

class ForumContaMensagensExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'topico2quantidade_mensagens',
                array (
                    $this,
                    'getTopico2QuantidadeMensagens'
                )
            )
        );
    }

    public function getTopico2QuantidadeMensagens($topico_id) {
        $return = $this->em->createQueryBuilder()
            ->select('COUNT(m)')
            ->from('Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem', 'm')
            ->leftJoin('m.topico', 't')
            ->where('t.id = :topico')
            ->setParameter('topico', $topico_id)
            ->getQuery()
            ->getOneOrNullResult();

        return (int) $return[1];
    }

    public function getName() {
        return 'topico2quantidade_mensagens';
    }
}

