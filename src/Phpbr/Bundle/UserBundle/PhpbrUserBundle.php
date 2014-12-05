<?php

namespace Phpbr\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PhpbrUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
