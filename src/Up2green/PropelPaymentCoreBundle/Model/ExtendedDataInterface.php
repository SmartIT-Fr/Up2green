<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

interface ExtendedDataInterface
{
    function isEncryptionRequired($name);
    function remove($name);
    function set($name, $value, $encrypt = true);
    function get($name);
    function has($name);
    function all();
    function equals($data);
}
