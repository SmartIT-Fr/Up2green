<?php

namespace Up2green\SearchBundle\Services\Engine;

use Symfony\Component\Security\Core\SecurityContext;

/**
 * Abstract Engine class
 */
abstract class Engine
{
    protected $securityContext;
    protected $query;

    /**
     * Constructor
     *
     * @param SecurityContext $securityContext 
     */
    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * @param string $query 
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }
}
