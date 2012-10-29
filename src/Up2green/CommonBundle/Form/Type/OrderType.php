<?php

namespace Up2green\CommonBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * Order form
 */
class OrderType extends AbstractType
{
    /**
     * @param FormBuilderInterface 	$builder
     * @param array                 $options
     *
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', 'number', array(
                'label' => 'form.order_type.amount',
            ));
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

        $resolver->setDefaults(array(
            'data_class' => 'Up2green\CommonBundle\Model\Order'
        ));
    }
}
