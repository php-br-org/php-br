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
            ->add('name')
            ;
    }

    public function getParent() {
        return 'fos_user_registration';
    }

    public function getName() {
        return 'phpbr_user_registration';
    }
}