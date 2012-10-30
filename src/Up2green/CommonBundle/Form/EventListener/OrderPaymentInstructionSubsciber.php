<?php

namespace Up2green\CommonBundle\Form\EventListener;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Routing\Router;

/**
 * OrderPaymentInstruction Subsciber
 * Regenerate the payment instruction field on the post data
 */
class OrderPaymentInstructionSubsciber implements EventSubscriberInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $factory;

    /**
     * @var Router
     */
    private $router;

    /**
     * @param FormFactoryInterface $factory
     */
    public function __construct(FormFactoryInterface $factory, Router $router)
    {
        $this->factory = $factory;
        $this->router = $router;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that we want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::POST_SET_DATA => 'postSetData');
    }

    /**
     * @param DataEvent $event
     *
     * @return null
     */
    public function postSetData(DataEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        // During form creation setData() is called with null as an argument
        // by the FormBuilder constructor. We're only concerned with when
        // setData is called with an actual Entity object in it (whether new
        // or fetched with Doctrine). This if statement lets us skip right
        // over the null condition.
        if (null === $data) {
            return;
        }

        if (!$data->isNew()) {

            $config = $form->getConfig();

            if (!$config->hasOption('payment_return_route') || !$config->hasOption('payment_cancel_route')) {
                throw new InvalidConfigurationException('Both "payment_return_route" and "payment_cancel_route" options are required');
            }

            $form->remove('payment_instruction');
            $form->add($this->factory->createNamed(
                'payment_instruction',
                'jms_choose_payment_method',
                null,
                array(
                    'amount'   => $data->getAmount(),
                    'currency' => 'EUR',
                    'default_method' => 'payment_paypal',
                    'predefined_data' => array(
                        'paypal_express_checkout' => array(
                            'return_url' => $this->router->generate($config->getOption('payment_return_route'), array(
                                'id' => $data->getId(),
                            ), true),
                            'cancel_url' => $this->router->generate($config->getOption('payment_cancel_route'), array(
                                'id' => $data->getId(),
                            ), true)
                        ),
                    )
                )
            ));
        }
    }
}