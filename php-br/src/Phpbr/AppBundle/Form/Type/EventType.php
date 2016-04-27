<?php

namespace Phpbr\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nome do Evento'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descrição',
                'attr' => [
                    'rows' => '15'
                ]
            ])
            ->add('location', TextType::class, ['label' => 'Localização'])
            ->add('day', 'text', [
                'label' => 'Dia'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Salvar'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\AppBundle\Entity\Event'
        ));
    }

    public function getBlockPrefix() {
        return 'phpbr_appbundle_event';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
