<?php

namespace Phpbr\Bundle\AppBundle\Pagerfanta;

use Phpbr\Bundle\AppBundle\Pagerfanta\Template\PhpbrTemplate;
use Pagerfanta\View\DefaultView;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class CustomView extends DefaultView
{

    protected $translator;

    public function __construct(Translator $translator) {
        $this->translator = $translator;
        parent::__construct();
    }

    protected function createDefaultTemplate()
    {
        $labels = array(
            'next' => $this->translator->trans('phpbr.paginacao.proximo'),
            'previous' => $this->translator->trans('phpbr.paginacao.anterior')
        );

        return new PhpbrTemplate($labels);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'phpbr';
    }
}
