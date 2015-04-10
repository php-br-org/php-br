<?php

namespace Phpbr\Bundle\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumCategoriaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add(
                'nome', 'text'
            )
            ->add(
                'descricao', 
                'textarea', 
                array(
                    'attr' => array(
                        'rows' => 5
                    ), 
                    'required' => true
                )
            )
            ->add('Salvar', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\Bundle\AppBundle\Entity\Forum\Categoria'
        ));
    }

    public function getName() {
        return 'phpbr_forum_admin_nova_categoria';
    }
}


