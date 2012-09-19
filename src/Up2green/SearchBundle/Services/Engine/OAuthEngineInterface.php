<?php

namespace Up2green\SearchBundle\Services\Engine;

/**
 * Engine interface
 */
interface OAuthEngineInterface
{
    /**
     * Set the requested keywork for search
     *
     * @param string $query
     */
    public function setQuery($query);

    /**
     * Return an array of results
     */
    public function getResults();
}
