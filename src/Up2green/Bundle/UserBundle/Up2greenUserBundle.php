<?php

namespace Up2green\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * User Bundle 
 */
class Up2greenUserBundle extends Bundle
{
    /**
     * @see Symfony\Component\HttpKernel\Bundle\Bundle
     * @return string 
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
