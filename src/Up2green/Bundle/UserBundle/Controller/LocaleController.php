<?php

namespace Up2green\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LocaleController extends Controller
{
    /**
     * Change the user current language
     *
     * @Route("/change-language/{locale}", name="user_locale_change")
     */
    public function changeAction($locale)
    {
        $this->get('session')->setLocale($locale);
        
        return $this->redirect($this->generateUrl('homepage'));
    }
}
