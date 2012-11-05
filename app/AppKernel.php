<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),

            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle(),

            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),

            new Propel\PropelBundle\PropelBundle(),
            new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Buzz\Bundle\ProfilerBundle\BuzzProfilerBundle(),
            new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Ornicar\GravatarBundle\OrnicarGravatarBundle(),
            new Craue\TwigExtensionsBundle\CraueTwigExtensionsBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),

            // Payment
            new JMS\Payment\CoreBundle\JMSPaymentCoreBundle(),
            new JMS\Payment\PaypalBundle\JMSPaymentPaypalBundle(),

            // Admin Generator
            new Admingenerator\GeneratorBundle\AdmingeneratorGeneratorBundle(),
            new Admingenerator\OldThemeBundle\AdmingeneratorOldThemeBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Admingenerator\UserBundle\AdmingeneratorUserBundle(),
            new Admingenerator\ActiveAdminThemeBundle\AdmingeneratorActiveAdminThemeBundle(),

            // Up2green
            new Up2green\BlogBundle\Up2greenBlogBundle(),
            new Up2green\CommonBundle\Up2greenCommonBundle(),
            new Up2green\UserBundle\Up2greenUserBundle(),
            new Up2green\SearchBundle\Up2greenSearchBundle(),
            new Up2green\ReforestationBundle\Up2greenReforestationBundle(),
            new Up2green\EducationBundle\Up2greenEducationBundle(),
            new Up2green\AdminBundle\Up2greenAdminBundle(),
            new Up2green\PropelPaymentCoreBundle\Up2greenPropelPaymentCoreBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
