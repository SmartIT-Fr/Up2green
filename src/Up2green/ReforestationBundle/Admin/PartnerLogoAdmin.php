<?php

namespace Up2green\ReforestationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Partner logo admin class
 */
class PartnerLogoAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $fileOptions = array('required' => false);

        /** @var \Up2green\ReforestationBundle\Entity\PartnerLogo $subject */
        if (($subject = $this->getSubject()) && $subject->getSrc()) {
            $fileOptions['help_inline'] = '<img style="max-width:200px; max-height: 200px;" src="' . $subject->getSrc() . '" />';
        }

        $formMapper
            ->add('partner')
            ->add('src', 'file', $fileOptions)
            ->add('href')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('partner')
            ->add('href')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('partner')
            ->add('href')
        ;
    }
}