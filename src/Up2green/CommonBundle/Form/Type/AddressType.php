<?php

namespace Up2green\CommonBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * Address form
 */
class AddressType extends AbstractType
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
            ->add('name', 'text', array(
                'label' => 'form.address.title'
            ))
            ->add('street_line_1', 'text', array(
                'label' => 'street_line_1'
            ))
            ->add('street_line_2', 'text', array(
                'label' => 'street_line_2',
                // TODO : the required option seems to be useless but in
                // the AdminBundle this field is required unless we set it here
                'required' => false,
            ))
            ->add('zipcode', 'integer', array(
                'label' => 'zipcode'
            ))
            ->add('city', 'text', array(
                'label' => 'city'
            ))
            ->add('country', 'text', array(
                'label' => 'country'
            ));
    }

    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.FormTypeInterface::getName()
     * @return string
     */
    public function getName()
    {
        return 'common_address';
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
            'data_class' => 'Up2green\CommonBundle\Model\Address'
        ));
    }
}
