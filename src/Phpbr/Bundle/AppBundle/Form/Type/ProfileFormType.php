<?php

namespace Phpbr\Bundle\AppBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        // Lista de campos customizaveis
        $builder
            ->add('name', 'text', array('label' => 'Nome', 'required' => true))
            ->add('linkedin', 'url', array('label' => 'LinkedIn', 'required' => false))
            ->add('twitter', 'text', array('label' => 'Twitter', 'attr' => array('placeholder' => '@Usuario'), 'required' => false))
            ->add('github', 'text', array('label' => 'Conta GitHub', 'required' => false))
            ;
    }

    public function getParent() {
        return 'fos_user_profile';
    }

    public function getName() {
        return 'phpbr_user_profile';
    }
}