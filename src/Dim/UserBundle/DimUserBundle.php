<?php

namespace Dim\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DimUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
