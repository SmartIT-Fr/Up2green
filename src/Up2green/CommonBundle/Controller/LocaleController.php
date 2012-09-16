<?php

namespace Up2green\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Locale controller
 */
class LocaleController extends Controller
{
    /**
     * Redirects towards the referer, the locale switch is done in LocaleListener
     *
     * @Route("/switch-locale/{_locale}", name="common_switch_locale")
     * @return array
     */
    public function switchLocaleAction()
    {
        $request = $this->get('request');
        $referer = $request->headers->get('referer');
        if ($referer == null) {
            return new RedirectResponse($this->generateUrl('homepage'));
        }

        return new RedirectResponse($referer);
    }
}
