<?php

namespace Phpbr\AppBundle\Twig;

use Doctrine\ORM\EntityManager;

class ForumTopicExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'qty_topics',
                array (
                    $this,
                    'getQtyTopics'
                )
            )
        );
    }

    public function getQtyTopics($category_id) {
        $topics = $this->em->getRepository('PhpbrAppBundle:Forum\Topic')
            ->findBy(
                array('category' => $category_id)
            );

        return count($topics);
    }

    public function getName() {
        return 'qty_topics';
    }
}

