<?php

namespace Up2green\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Up2greenUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
