<?php
namespace Up2green\CommonBundle\Test;
use Symfony\Bundle\FrameworkBundle\Client as BaseClient;

/**
 * Client class
 * Implement here usefull functions for tests, like connect
 */
class Client extends BaseClient
{
    /**
     * @param string $username
     * @param string $password
     *
     * @return \Up2green\CommonBundle\Test\Client
     */
    public function connect($username, $password)
    {
        $form = $this->request('GET', '/login')
            ->selectButton('_submit')
            ->form(array(
                '_username' => $username,
                '_password' => $password,
            ));

        $this->submit($form);

        return $this;
    }
}
