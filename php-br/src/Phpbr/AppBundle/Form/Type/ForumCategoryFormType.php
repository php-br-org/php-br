<?php

namespace Phpbr\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ForumCategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add(
                'name', TextType::class
            )
            ->add(
                'description',
                TextAreaType::class,
                array(
                    'attr' => array(
                        'rows' => 5
                    ), 
                    'required' => true
                )
            )
            ->add('Salvar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\AppBundle\Entity\Forum\Category'
        ));
    }

    public function getBlockPrefix() {
        return 'phpbr_forum_admin_new_category';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}


