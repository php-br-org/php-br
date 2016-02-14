<?php

namespace Phpbr\AppBundle\Pagerfanta;

use Phpbr\AppBundle\Pagerfanta\Template\PhpbrTemplate;
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
            'next' => $this->translator->trans('phpbr.pagination.next'),
            'previous' => $this->translator->trans('phpbr.pagination.previous')
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
