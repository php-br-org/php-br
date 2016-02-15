<?php

namespace Phpbr\AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Phpbr\AppBundle\Entity\Forum\Message;

class ForumCategoryExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'categoryLastMessage',
                array (
                    $this,
                    'getLastMessage'
                )
            )
        );
    }

    public function getLastMessage($category_id) {
        $repository = $this->em->getRepository('PhpbrAppBundle:Forum\Message');

        try {
            $lastMessage = $this->em->createQueryBuilder($repository)
                ->select('m')
                ->from('PhpbrAppBundle:Forum\Message', 'm')
                ->leftJoin('m.topic', 't')
                ->leftJoin('t.category', 'c')
                ->where('c.id = :category')
                ->setParameter('category', $category_id)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

            $createdAt = $lastMessage ? $lastMessage->getCreatedAt() : null;

            return $createdAt;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function getName() {
        return 'categoryLastMessage';
    }
}

