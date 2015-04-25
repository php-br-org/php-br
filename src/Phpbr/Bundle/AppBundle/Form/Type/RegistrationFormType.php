<?php

namespace Phpbr\Bundle\AppBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        // Lista de campos customizaveis
        $builder
            ->add('name', 'text', array(
                'label' => 'Nome',
                'required' => true
            ))
            ->add('linkedin', 'url', array(
                'label' => 'LinkedIn',
                'required' => false
            ))
            ->add('twitter', 'text', array(
                'label' => 'Twitter',
                'attr' => array(
                    'placeholder' => 'https://twitter.com/usuario'
                ),
                'required' => false
            ))
            ->add('github', 'text', array(
                'label' => 'GitHub',
                'attr' => array(
                    'placeholder' => 'https://github.com/usuario'
                ),
                'required' => false))
            ->add('captcha', 'captcha');
    }

    public function getParent() {
        return 'fos_user_registration';
    }

    public function getName() {
        return 'phpbr_user_registration';
    }
}
