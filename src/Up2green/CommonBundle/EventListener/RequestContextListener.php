<?php

namespace Up2green\CommonBundle\EventListener;

use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;

/**
 * Add some default attributes to the request context
 */
class RequestContextListener implements EventSubscriberInterface
{
    private $requestContext;
    private $domain;

    /**
     * @param RequestContext $requestContext The request context
     * @param string         $domain         The domain name
     */
    public function __construct(RequestContext $requestContext, $domain)
    {
        $this->requestContext = $requestContext;
        $this->domain         = $domain;
    }

    /**
     * @param KernelEvent $event
     */
    public function onKernelRequest(KernelEvent $event)
    {
        $this->requestContext->setParameter('domain', $this->domain);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => 'onKernelRequest',
        );
    }
}