<?php

namespace Up2green\AdminBundle\Form\Type\WaitingList;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Admingenerated\Up2greenAdminBundle\Form\BaseWaitingListType\NewType as BaseNewType;

/**
 * New WaitingList type
 */
class NewType extends BaseNewType
{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        parent::buildForm($builder, $options);
//
//        $builder->remove('address_id');
//
//        $builder->add('address', 'common_address', array(
//            'label' => 'delivery_address'
//        ));
//    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'cascade_validation' => true
        ));
    }
}
