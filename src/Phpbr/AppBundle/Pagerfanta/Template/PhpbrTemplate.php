<?php

namespace Phpbr\AppBundle\Pagerfanta\Template;

use Pagerfanta\View\Template\Template;

class PhpbrTemplate extends Template
{
    protected $labels;

    static protected $defaultOptions = array(
        'prev_message'        => '« Anterior',
        'prev_disabled_href'  => '#',
        'next_message'        => 'Proximo »',
        'next_disabled_href'  => '#',
        'dots_message'        => '&hellip;',
        'dots_href'           => '#',
        'css_main_class'      => 'pagination-centered',
        'css_container_class' => 'pagination',
        'css_first_class'     => 'first ico',
        'css_last_class'      => 'next ico',
        'css_disabled_class'  => 'hide',
        'css_dots_class'      => '',
        'css_active_class'    => 'current'
    );

    public function __construct($labels)
    {
        $this->labels = $labels;
        parent::__construct();
    }

    public function container()
    {
        return sprintf('<div class="%s"><ul class="%s">%%pages%%</ul></div>',
            $this->option('css_main_class'),
            $this->option('css_container_class')
        );
    }

    public function page($page)
    {
        $text = $page;

        return $this->pageWithText($page, $text);
    }

    public function pageWithText($page, $text)
    {
        $class = null;

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    private function pageWithTextAndClass($page, $text, $class)
    {
        $href = $this->generateRoute($page);

        return $this->anchors($class, $href, $text, $page);
    }

    public function previousDisabled()
    {
        $class = $this->previousDisabledClass();
        $href = $this->generateRoute(1);
        $text = $this->labels['previous'];

        return $this->anchors($class, $href, $text, 1);
    }

    private function previousDisabledClass()
    {
        return $this->option('css_first_class').' '.$this->option('css_disabled_class');
    }

    public function previousEnabled($page)
    {
        $text = $this->labels['previous'];
        $class = $this->option('css_first_class');

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    public function nextDisabled()
    {
        $class = $this->nextDisabledClass();
        $href = $this->option('next_disabled_href');
        $text = $this->labels['next'];

        return $this->anchors($class, $href, $text, '');
    }

    private function nextDisabledClass()
    {
        return $this->option('css_last_class').' '.$this->option('css_disabled_class');
    }

    public function nextEnabled($page)
    {
        $text = $this->labels['next'];
        $class = $this->option('css_last_class');

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    public function first()
    {
        return $this->page(1);
    }

    public function last($page)
    {
        return $this->page($page);
    }

    public function current($page)
    {
        $text = $page;
        $class = $this->option('css_active_class');

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    public function separator()
    {
        $class = $this->option('css_dots_class');
        $href = $this->option('dots_href');
        $text = $this->option('dots_message');

        return $this->anchors($class, $href, $text);
    }

    private function anchors($class, $href, $text, $page = '')
    {
        $anchorClass = $class ? sprintf(' class="%s"', $class) : '';

        if ($class == $this->option('css_active_class')) {
            return "<li $anchorClass data-id-page='$page'>$page</li>";
        }

        return "<li><a href='$href' $anchorClass data-id-page='$page'>$text</a></li>";
    }
}