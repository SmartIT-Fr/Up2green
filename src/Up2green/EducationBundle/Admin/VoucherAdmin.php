<?php

namespace Up2green\EducationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Voucher admin class
 */
class VoucherAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add(
                'voucher', 
                'sonata_type_admin', 
                array('label' => 'form.label.voucher'), 
                array('inline' => true)
            );
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('voucher.code')
            // FIXME this field should have been guessed
            ->add('voucher.used_by', 'model', array(), null, array(
                'class' => 'FOS\UserBundle\Propel\User',
            ))
            // FIXME this field should have been guessed
            ->add('voucher.owner_id', 'model', array(), null, array(
                'class' => 'FOS\UserBundle\Propel\User',
            ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('voucher')
            ->add('voucher.user')
            ->add('voucher.owner');
    }
}