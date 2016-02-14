<?php

namespace Phpbr\AppBundle\Twig;

use Doctrine\ORM\EntityManager;

class ForumTopicoExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'quantidade_topicos',
                array (
                    $this,
                    'getQuantidadeTopicos'
                )
            )
        );
    }

    public function getQuantidadeTopicos($categoria_id) {
        $topicos = $this->em->getRepository('PhpbrAppBundle:Forum\Topico')
            ->findBy(
                array('categoria' => $categoria_id)
            );

        return count($topicos);
    }

    public function getName() {
        return 'quantidade_topicos';
    }
}

