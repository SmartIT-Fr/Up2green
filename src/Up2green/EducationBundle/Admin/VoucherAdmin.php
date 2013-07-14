<?php

namespace Up2green\EducationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Voucher admin class
 */
class VoucherAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Route\RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('generate');
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getTemplate($name)
    {
        switch ($name) {
            case 'list':
                return 'Up2greenEducationBundle:Admin\Voucher:list.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
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

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
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

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('voucher')
            ->add('voucher.user')
            ->add('voucher.owner');
    }
}