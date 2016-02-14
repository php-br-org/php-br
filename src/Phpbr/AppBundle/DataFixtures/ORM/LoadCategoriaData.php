<?php

namespace Phpbr\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Phpbr\AppBundle\Entity\Forum\Category;

class LoadCategoryData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Frameworks');
        $category->setDescription('Discussões sobre diversos frameworks. Symfony2, Laravel, Yii, Cakephp, Codeigniter, etc');
        $category->setStatus('1');
        $category->setCreatedAt(new \DateTime());

        $manager->persist($category);
        $manager->flush();
        $category = null;


        $category = new Category();
        $category->setName('Alta Disponibilidade');
        $category->setDescription('Loadbalancers, Cloud, Redundancia, Alta-disponibilidade');
        $category->setStatus('1');
        $category->setCreatedAt(new \DateTime());

        $manager->persist($category);
        $manager->flush();
        $category = null;


        $category = new Category();
        $category->setName('PHP em Geral');
        $category->setDescription('PHP em Geral');
        $category->setStatus('1');
        $category->setCreatedAt(new \DateTime());

        $manager->persist($category);
        $manager->flush();
        $category = null;


        $category = new Category();
        $category->setName('Servidores Web');
        $category->setDescription('Nginx, Apache, etc');
        $category->setStatus('1');
        $category->setCreatedAt(new \DateTime());

        $manager->persist($category);
        $manager->flush();
        $category = null;

    }
}

