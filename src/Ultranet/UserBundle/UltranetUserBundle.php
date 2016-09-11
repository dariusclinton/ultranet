<?php

namespace Ultranet\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UltranetUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
