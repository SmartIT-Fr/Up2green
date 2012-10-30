<?php

namespace Up2green\CommonBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Up2green\CommonBundle\Form\EventListener\OrderPaymentInstructionSubsciber;

/**
 * Order form
 */
class OrderType extends AbstractType
{
    /**
     * @var OrderPaymentInstructionSubsciber
     */
    protected $paymentInstructionSubscriber;

    /**
     * @param OrderPaymentInstructionSubsciber $paymentInstructionSubscriber
     */
    public function __construct(OrderPaymentInstructionSubsciber $paymentInstructionSubscriber)
    {
        $this->paymentInstructionSubscriber = $paymentInstructionSubscriber;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', 'number', array(
                'label' => 'form.order_type.amount',
            ))
            ->add('payment_instruction', 'jms_choose_payment_method', array(
                'amount'   => 0,
                'currency' => 'EUR',
                'default_method' => 'payment_paypal',
                'predefined_data' => array()
            ))
            ->addEventSubscriber($this->paymentInstructionSubscriber);
    }

    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.FormTypeInterface::getName()
     * @return string
     */
    public function getName()
    {
        return 'common_order';
    }

    /**
     * (non-PHPdoc)
     *
     * @param OptionsResolverInterface $resolver
     *
     * @see Symfony\Component\Form.AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver
            ->setRequired(array(
                'payment_return_route', 'payment_cancel_route',
            ))
            ->setDefaults(array(
                'data_class' => 'Up2green\CommonBundle\Model\Order'
            ));
    }
}
