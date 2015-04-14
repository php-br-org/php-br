<?php

namespace Phpbr\Bundle\AppBundle\Twig;

use Doctrine\ORM\EntityManager;
use Phpbr\Bundle\AppBundle\Entity\Forum\Mensagem;

class ForumCategoriaExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter(
                'categoria2ultima_mensagem',
                array (
                    $this,
                    'getUltimaMensagem'
                )
            )
        );
    }

    public function getUltimaMensagem($categoria_id) {

        $repository = $this->em->getRepository('PhpbrAppBundle:Forum\Mensagem');

        try {
            $ultimaMensagem = $this->em->createQueryBuilder($repository)
                ->select('m')
                ->from('PhpbrAppBundle:Forum\Mensagem', 'm')
                ->leftJoin('m.topico', 't')
                ->leftJoin('t.categoria', 'c')
                ->where('c.id = :categoria')
                ->setParameter('categoria', $categoria_id)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

            $dataCriacao = $ultimaMensagem ? $ultimaMensagem->getDataCriacao() : null;

            return $dataCriacao;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function getName() {
        return 'categoria2ultima_mensagem';
    }
}

