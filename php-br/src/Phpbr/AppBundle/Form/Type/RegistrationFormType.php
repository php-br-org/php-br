<?php

namespace Phpbr\AppBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        // Custom fields
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nome',
                'required' => true
            ))
            ->add('linkedin', UrlType::class, array(
                'label' => 'LinkedIn',
                'required' => false
            ))
            ->add('twitter', TextType::class, array(
                'label' => 'Twitter',
                'attr' => array(
                    'placeholder' => 'https://twitter.com/usuario'
                ),
                'required' => false
            ))
            ->add('github', TextType::class, array(
                'label' => 'GitHub',
                'attr' => array(
                    'placeholder' => 'https://github.com/usuario'
                ),
                'required' => false))
            ->add('captcha', CaptchaType::class);
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'phpbr_user_registration';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
