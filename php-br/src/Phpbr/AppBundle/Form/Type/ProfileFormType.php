<?php

namespace Phpbr\AppBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        // Lista de campos customizaveis
        $builder
            ->add('name', TextType::class, array('label' => 'Nome', 'required' => true))
            ->add('linkedin', UrlType::class, array('label' => 'LinkedIn', 'required' => false))
            ->add('twitter', TextType::class, array('label' => 'Twitter', 'attr' => array('placeholder' => '@Usuario'), 'required' => false))
            ->add('github', TextType::class, array('label' => 'Conta GitHub', 'required' => false))
            ;
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix() {
        return 'phpbr_user_profile';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}