<?php

namespace Phpbr\Bundle\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('tipo', 'choice', array(
                'choices' => array(
                    'text'   => 'Texto',
                    'actionscript' => 'ActionScript',
                    'actionscript-french'   => 'ActionScript (French Doc Links)',
                    'ada' => 'Ada',
                    'apache' => 'Apache',
                    'applescript' => 'AppleScript',
                    'asm' => 'ASM (Nasm)',
                    'asp' => 'Asp',
                    'bash' => 'Bash',
                    'blitzbasic' => 'BlitzBasic',
                    'c' => 'C',
                    'c_mac' => 'C for Macs',
                    'caddcl' => 'CAD DCL',
                    'cadlist' => 'CAD List',
                    'cpp' => 'C++',
                    'csharp' => 'C#',
                    'css' => 'CSS',
                    'd' => 'D',
                    'delphi' => 'Delphi',
                    'diff' => 'Diff',
                    'div' => 'DIV',
                    'dos' => 'DOS',
                    'eiffel' => 'Eiffel',
                    'freebasic' => 'FreeBasic',
                    'gml' => 'GML',
                    'html4strict' => 'HTML 4.0.1',
                    'inno' => 'Inno',
                    'java' => 'Java',
                    'javascript' => 'Javascript',
                    'lisp' => 'Lisp',
                    'lua' => 'Lua',
                    'matlab' => 'Matlab',
                    'mpasm' => 'MPASM',
                    'mysql' => 'MySQL',
                    'nsis' => 'NullSoft Installer',
                    'ocaml' => 'OCaml',
                    'ocam-brief' => 'OCaml (Brief)',
                    'oobas' => 'Openoffice.org BASIC',
                    'oracle8' => 'Oracle 8',
                    'pascal' => 'Pascal',
                    'perl' => 'Perl',
                    'php' => 'PHP',
                    'php-brief' => 'PHP (Brief version)',
                    'text' => 'Plain Text',
                    'python' => 'Python',
                    'qbasic' => 'QBasic/QuickBASIC',
                    'ruby' => 'Ruby',
                    'scheme' => 'Scheme',
                    'sdlbasic' => 'SDLBasic',
                    'smarty' => 'Smarty',
                    'sql' => 'SQL',
                    'vb' => 'VisualBasic',
                    'vbnet' => 'VB.NET',
                    'vhdl' => 'VHDL',
                    'visualfoxpro' => 'VisualFoxPro',
                    'xml' => 'XML',
                ),
                'data' => 'php'
            ))
            ->add('codigo', 'textarea', array(
                'attr' => array(
                    'rows' => '25',
                    'class' => 'lined'
                )
            ))
            ->add('captcha', 'captcha');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Phpbr\Bundle\AppBundle\Entity\Cole'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phpbr_bundle_appbundle_cole';
    }
}
