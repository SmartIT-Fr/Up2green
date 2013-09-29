<?php

namespace Up2green\EducationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Classroom admin class
 */
class ClassroomAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('year', null, array(
                'data' => (int) date('Y'),
            ))
            ->add('uploadedFile', 'file', array(
                'required' => false
            ))
            ->add('description')
            ->add('school')
            ->add('partner', null, array(
                'required' => false
            ))
            ->add('user', 'model', array(
                'class' => 'FOS\UserBundle\Propel\User'
            ))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('year')
            ->add('school')
            ->add('user', null, array(), 'model', array(
                'class' => 'FOS\UserBundle\Propel\User'
            ))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('year')
            ->add('school.name')
            ->add('user')
        ;
    }
}