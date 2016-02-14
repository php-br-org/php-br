<?php

namespace Phpbr\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title',
                TextType::class,
                array(
                    'attr' => array(
                        'class' => '',
                        'label' => 'x'),
                    'required' => true
                )
            )
            ->add(
                'excerpt',
                TextAreaType::class,
                array(
                    'attr' => array(
                        'class' => 'countdown-resumo',
                        'rows' => 5,
                        'maxlength' => '255'),
                    'required' => false
                )
            )
            ->add(
                'content',
                TextAreaType::class,
                array(
                    'attr' => array(
                        'class' => 'meltdown-editor',
                        'rows' => 15
                    ), 
                    'required' => true
                )
            )
            ->add('tags', null, array('attr' => array('class' => ''), 'required' => false))
            ->add('published', ChoiceType::class, array(
                'choices' => array(
                    '0' => 'phpbr.article.form.publish_options.draft',
                    '1' => 'phpbr.article.form.publish_options.publish',
                ),
                'expanded' => true,
                'data' => '0',
            ))
            ->add('Salvar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\AppBundle\Entity\Article',
            'translation_domain' => 'article'
        ));
    }

    public function getBlockPrefix() {
        return 'phpbr_article_new';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
