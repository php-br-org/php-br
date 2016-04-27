<?php

namespace Phpbr\AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Phpbr\AppBundle\Entity\Forum\Message;

class ForumMessageExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'qty_messages',
                array (
                    $this,
                    'getQtyMessages'
                )
            )
        );
    }

    public function getQtyMessages($category_id) {
        $return = $this->em->createQueryBuilder()
            ->select('COUNT(m)')
            ->from('Phpbr\AppBundle\Entity\Forum\Message', 'm')
            ->leftJoin('m.topic', 't')
            ->leftJoin('t.category', 'c')
            ->where('c.id = :category')
            ->setParameter('category', $category_id)
            ->getQuery()
            ->getOneOrNullResult();

        return (int) $return[1];
    }

    public function getName() {
        return 'qty_messages';
    }
}

