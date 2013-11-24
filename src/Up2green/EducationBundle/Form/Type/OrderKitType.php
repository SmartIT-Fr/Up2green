<?php

namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * Order a kit form
 */
class OrderKitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', array(
                'label' => 'firstname'
            ))
            ->add('lastName', 'text', array(
                'label' => 'lastname'
            ))
            ->add('email', 'email', array(
                'label' => 'email'
            ))
            ->add('phoneNumber', 'text', array(
                'label' => 'telephone'
            ))
            ->add('kitsNumber', 'integer', array(
                'label' => 'kits_number'
            ))
            ->add('address', 'common_address', array(
                'label' => 'delivery_address'
            ))
            ->add('captcha', 'captcha', array(
                'label' => 'captcha'
            ));
    }

    /**
     * @see Symfony\Component\Form.FormTypeInterface::getName()
     * @return string
     */
    public function getName()
    {
        return 'order_kit';
    }

    /**
     * @param OptionsResolverInterface $resolver
     *
     * @see Symfony\Component\Form.AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\Entity\OrderKit',
            'cascade_validation' => true,
        ));
    }
}
