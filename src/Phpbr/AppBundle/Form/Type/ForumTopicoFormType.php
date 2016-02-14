<?php

namespace Phpbr\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumTopicoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('assunto', null, array('attr' => array('class' => ''), 'required' => true))
            ->add(
                'mensagem', 
                'textarea', 
                array(
                    'attr' => array(
                        'class' => 'meltdown-editor',
                        'rows' => 15
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
            'data_class' => 'Phpbr\AppBundle\Entity\Forum\Topico'
        ));
    }

    public function getBlockPrefix() {
        return 'phpbr_forum_topico_novo';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
