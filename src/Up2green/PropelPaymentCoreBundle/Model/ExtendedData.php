<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

use Up2green\PropelPaymentCoreBundle\Model\ExtendedDataInterface;
use Up2green\PropelPaymentCoreBundle\Model\om\BaseExtendedData;

/**
 * Extended data entity
 */
class ExtendedData extends BaseExtendedData implements ExtendedDataInterface
{
    /**
     * @param string $name
     *
     * @return boolean
     */
    public function isEncryptionRequired($name)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException(sprintf('There is no data with key "%s".', $name));
        }

        return $this->data[$name][1];
    }

    /**
     * @param string $name
     */
    public function remove($name)
    {
        unset($this->data[$name]);
    }

    /**
     * @param string  $name
     * @param mixed   $value
     * @param boolean $encrypt
     * @param boolean $persist
     */
    public function set($name, $value, $encrypt = true, $persist = true)
    {
        if ($encrypt && !$persist) {
            throw new \InvalidArgumentException(sprintf('Non persisted field cannot be encrypted "%s".', $name));
        }

        $this->data[$name] = array($value, $encrypt, $persist);
    }

    /**
     * @return mixed
     */
    public function get($name)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException(sprintf('There is no data with key "%s".', $name));
        }

        return $this->data[$name][0];
    }

    /**
     * @return boolean
     */
    public function has($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @return boolean
     */
    public function equals($data)
    {
        if (!$data instanceof ExtendedDataInterface) {
            return false;
        }

        return $data->getData() === $this->getData();
    }
}
