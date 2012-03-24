<?php

namespace Up2green\Bundle\UserBundle\Controller;

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
     * @Route("/change-language/{locale}", name="user_locale_change")
     *
     * @param string $locale 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @todo Redirect the user to the page where it comes
     */
    public function changeAction($locale)
    {
        $this->get('session')->setLocale($locale);
        
        return $this->redirect($this->generateUrl('search_homepage'));
    }
}
