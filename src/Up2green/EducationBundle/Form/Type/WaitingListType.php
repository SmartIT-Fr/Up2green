<?php

namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * Waiting list form
 */
class WaitingListType extends AbstractType
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
            ->add('first_name', 'text', array(
                'label' => 'firstname'
            ))
            ->add('last_name', 'text', array(
                'label' => 'lastname'
            ))
            ->add('email', 'repeated', array(
                'first_name' => 'email',
                'second_name' => 'confirm_email',
                'first_options'  => array('label' => 'email'),
                'second_options' => array('label' => 'confirm_email'),
                'type' => 'email',
            ))
            ->add('phone_number', 'text', array(
                'label' => 'telephone'
            ))
            ->add('kits_number', 'integer', array(
                'label' => 'kits_number',
                'help_block'  => 'kits_number.help'
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
        return 'join_waiting_list';
    }

    /**
     * @param OptionsResolverInterface $resolver
     *
     * @see Symfony\Component\Form.AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\Entity\WaitingList',
            'cascade_validation' => true
        ));
    }
}
