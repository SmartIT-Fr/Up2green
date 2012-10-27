<?php

namespace Up2green\CommonBundle\Test;

/**
 * Isolated Web Test Case
 */
class IsolatedWebTestCase extends WebTestCase
{
    protected $_application;

    /**
     * @see http://www.phpunit.de/manual/3.0/en/fixtures.html#fixtures.more-setup-than-teardown
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_application = new \Symfony\Bundle\FrameworkBundle\Console\Application(static::$kernel);
        $this->_application->setAutoExit(false);

        // FIXME : https://github.com/propelorm/PropelBundle/issues/177
//        $this->runConsole("propel:database:drop", array("--force" => true));
//        $this->runConsole("propel:database:create");
//        $this->runConsole("propel:build", array("--insert-sql" => true));
//        $this->runConsole("propel:fixtures:load");
    }

    /**
     * @param string $command
     * @param array  $options
     *
     * @return mixed
     */
    protected function runConsole($command, array $options = array())
    {
        $options["-e"] = "test";
        $options["-q"] = null;
        $options = array_merge($options, array('command' => $command));

        return $this->_application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
    }

    /**
     * @see http://www.phpunit.de/manual/3.0/en/fixtures.html#fixtures.more-setup-than-teardown
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
