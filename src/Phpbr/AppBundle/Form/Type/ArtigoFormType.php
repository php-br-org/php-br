<?php

namespace Phpbr\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtigoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('titulo', null, array('attr' => array('class' => ''), 'required' => true))
            ->add(
                'resumo',
                'textarea',
                array(
                    'attr' => array(
                        'class' => 'countdown-resumo',
                        'rows' => 5,
                        'maxlength' => '255'),
                    'required' => false
                )
            )
            ->add(
                'texto', 
                'textarea', 
                array(
                    'attr' => array(
                        'class' => 'meltdown-editor',
                        'rows' => 15
                    ), 
                    'required' => true
                )
            )
            ->add('tags', null, array('attr' => array('class' => ''), 'required' => false))
            ->add('publicado', 'choice', array(
                'choices' => array(
                    '0' => 'Salvar como Rascunho',
                    '1' => 'Publicar Artigo',
                ),
                'expanded' => true,
                'data' => '0',
            ))
            ->add('Salvar', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\AppBundle\Entity\Artigo'
        ));
    }

    public function getBlockPrefix() {
        return 'phpbr_artigo_novo';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
