<?php

namespace Phpbr\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UrlType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class)
            ->add('descricao', TextType::class)
            ->add('createdAt', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\AppBundle\Entity\Url'
        ));
    }

    public function getBlockPrefix() {
        return 'phpbr_bundle_appbundle_url';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
