<?php

namespace Up2green\PropelPaymentCoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Up2green payment override for propel needs
 */
class Up2greenPropelPaymentCoreBundle extends Bundle
{
    /**
     * @see Symfony\Component\HttpKernel\Bundle\Bundle
     * @return string
     */
    public function getParent()
    {
        return 'JMSPaymentCoreBundle';
    }
}
