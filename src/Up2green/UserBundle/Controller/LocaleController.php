<?php

namespace Up2green\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * LocaleController : Manage the user locale actions
 */
class LocaleController extends Controller
{

    /**
     * Change the user current language
     *
     * @param string $locale
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @todo Redirect the user to the page where it comes
     *
     * @Route("/change-language/{locale}", name="user_locale_change")
     */
    public function changeAction($locale)
    {
        $this->getRequest()->setLocale($locale);

        return $this->redirect($this->generateUrl('search_homepage'));
    }
}
