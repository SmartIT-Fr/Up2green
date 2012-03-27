<?php
namespace Up2green\CommonBundle\Extension;

/**
 * TwigLocaleExtension
 */
class TwigLocaleExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'twig_locale_extension';
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'localeSwitch' => new \Twig_Function_Method($this, 'localeSwitch'),
        );
    }

    /**
     * Prepare route parameters for language switch.
     *
     * @param $newLocale
     * @param $requestAttributes
     *
     * @return array
     */
    public function localeSwitch($newLocale, $requestAttributes)
    {
        unset(
            $requestAttributes['_controller'],
            $requestAttributes['_route']
        );
        $requestAttributes['_locale'] = $newLocale;
        return $requestAttributes;
    }
}  