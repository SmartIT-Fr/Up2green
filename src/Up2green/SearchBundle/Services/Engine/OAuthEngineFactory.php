<?php

namespace Up2green\SearchBundle\Services\Engine;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * SearcheEngine factory class
 */
class OAuthEngineFactory
{
    const TYPE_WEB   = 0;
    const TYPE_IMAGE = 1;
    const TYPE_NEWS  = 2;

    public static $types = array(
        self::TYPE_WEB   => 'web',
        self::TYPE_IMAGE => 'image',
        self::TYPE_NEWS  => 'news',
    );

    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Create an Engine service to retrieve datas
     *
     * @param string $query The requested query string
     * @param int    $type  The search type
     *
     * @return \Up2green\SearchBundle\Services\SearchEngine\OAuthEngineInterface
     * @throws \InvalidArgumentException
     */
    public function createEngine($query, $type)
    {
        if (!isset (self::$types[$type])) {
            $error = sprintf("Search engine '%s' is not defined in the Factory", $type);
            throw new \InvalidArgumentException($error);
        }

        $serviceName = sprintf('up2green_search.engine.%s', self::$types[$type]);

        if (false === $this->container->has($serviceName)) {
            $error = sprintf("Search engine '%s' is not defined in the service container", self::$types[$type]);
            throw new \InvalidArgumentException($error);
        }

        $service = $this->container->get($serviceName);

        if (!$service instanceof OAuthEngineInterface) {
            $error = sprintf("Service '%s' must implement the OAuthEngineInterface", $serviceName);
            throw new \InvalidArgumentException($error);
        }

        $service->setQuery($query);

        return $service;
    }
}
