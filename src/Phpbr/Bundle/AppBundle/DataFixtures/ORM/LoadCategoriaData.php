<?php

namespace Phpbr\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Phpbr\Bundle\AppBundle\Entity\Forum\Categoria;

class LoadCategoriaData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $categoria = new Categoria();
        $categoria->setNome('Frameworks');
        $categoria->setDescricao('Discussões sobre diversos frameworks. Symfony2, Laravel, Yii, Cakephp, Codeigniter, etc');
        $categoria->setStatus('1');
        $categoria->setDataCriacao(new \DateTime());

        $manager->persist($categoria);
        $manager->flush();
        $categoria = null;


        $categoria = new Categoria();
        $categoria->setNome('Alta Disponibilidade');
        $categoria->setDescricao('Loadbalancers, Cloud, Redundancia, Alta-disponibilidade');
        $categoria->setStatus('1');
        $categoria->setDataCriacao(new \DateTime());

        $manager->persist($categoria);
        $manager->flush();
        $categoria = null;


        $categoria = new Categoria();
        $categoria->setNome('PHP em Geral');
        $categoria->setDescricao('PHP em Geral');
        $categoria->setStatus('1');
        $categoria->setDataCriacao(new \DateTime());

        $manager->persist($categoria);
        $manager->flush();
        $categoria = null;


        $categoria = new Categoria();
        $categoria->setNome('Servidores Web');
        $categoria->setDescricao('Nginx, Apache, etc');
        $categoria->setStatus('1');
        $categoria->setDataCriacao(new \DateTime());

        $manager->persist($categoria);
        $manager->flush();
        $categoria = null;

    }
}

