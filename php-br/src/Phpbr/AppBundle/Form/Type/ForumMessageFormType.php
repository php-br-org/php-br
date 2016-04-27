<?php

namespace Phpbr\AppBundle\Form\Type;

use Guzzle\Tests\Service\Mock\Command\Sub\Sub;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ForumMessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add(
                'message',
                TextAreaType::class,
                array(
                    'attr' => array(
                        'class' => 'meltdown-editor',
                        'rows' => 15
                    ), 
                    'required' => true
                )
            )
            ->add('Salvar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\AppBundle\Entity\Forum\Message'
        ));
    }

    public function getBlockPrefix() {
        return 'phpbr_forum_message_new';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
