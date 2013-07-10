<?php

namespace Up2green\CommonBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * School admin class
 */
class VoucherAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('code')
            // FIXME : This field should have been guessed
            ->add('owner', 'model', array(
                'class' => 'FOS\UserBundle\Propel\User',
                'label' => 'form.label.owner',
            ))
        ;
    }
}