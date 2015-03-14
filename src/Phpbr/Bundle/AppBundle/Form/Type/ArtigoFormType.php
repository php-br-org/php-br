<?php

namespace Phpbr\Bundle\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use BSky\Bundle\TextAreaCountdownBundle\Form\Extension\Type;

class ArtigoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('titulo', null, array('attr' => array('class' => ''), 'required' => true))
            ->add('resumo', 'textarea', array('attr' => array('class' => '', 'rows' => 5), 'required' => false))
            ->add(
                'texto', 
                'textarea', 
                array(
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'simple',
                        'rows' => 15
                    ), 
                    'required' => true
                )
            )
            ->add('tags', null, array('attr' => array('class' => ''), 'required' => false))
            ->add('publicado', 'choice', array(
                'choices' => array(
                    '0' => 'Salvar como Rascunho',
                    '1' => 'Publicar Artigo'
                'extended' => true,
                'data' => '0',
                ),
                'label' => 'Status do Artigo:',
                'required' => true
            ))
            ->add('Salvar', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\Bundle\AppBundle\Entity\Artigo'
        ));
    }

    public function getName() {
        return 'phpbr_artigo_novo';
    }
}
