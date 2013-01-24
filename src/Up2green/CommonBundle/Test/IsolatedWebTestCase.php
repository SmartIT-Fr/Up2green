<?php

namespace Up2green\CommonBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Isolated Web Test Case
 */
class IsolatedWebTestCase extends WebTestCase
{
    private static $application;

    /**
     * For each test class, it will build everthing before to execute test methods
     */
    public static function setUpBeforeClass()
    {
        \Propel::disableInstancePooling();

        self::runCommand('propel:build --insert-sql');
        self::runCommand('propel:fixtures:load');
    }

    protected static function getApplication()
    {
        if (null === self::$application) {
            $client = static::createClient();

            self::$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    protected static function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new \Symfony\Component\Console\Input\StringInput($command));
    }
}
