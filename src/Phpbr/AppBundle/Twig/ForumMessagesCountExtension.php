<?php

namespace Phpbr\AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Phpbr\AppBundle\Entity\Forum\Message;

class ForumMessagesCountExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'topicMessagesCount',
                array (
                    $this,
                    'getTopicMessagesCount'
                )
            )
        );
    }

    public function getTopicMessagesCount($topic_id) {
        $return = $this->em->createQueryBuilder()
            ->select('COUNT(m)')
            ->from('Phpbr\AppBundle\Entity\Forum\Message', 'm')
            ->leftJoin('m.topic', 't')
            ->where('t.id = :topic')
            ->setParameter('topic', $topic_id)
            ->getQuery()
            ->getOneOrNullResult();

        return (int) $return[1];
    }

    public function getName() {
        return 'topicMessagesCount';
    }
}

