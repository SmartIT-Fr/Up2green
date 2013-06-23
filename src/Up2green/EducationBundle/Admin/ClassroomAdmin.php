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
            ->add('name', null, array(
                'label' => 'form.classroom_type.name'
            ))
            ->add('year', null, array(
                'label' => 'form.classroom_type.year',
                'data' => (int) date('Y'),
            ))
            ->add('uploadedFile', 'file', array(
                'label'    => 'form.classroom_type.picture',
            ))
            ->add('description', null, array(
                'label' => 'form.classroom_type.description',
            ))
            ->add('school')
            // FIXME : This field should have been guessed
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
//            FIXME
//            ->add('school', 'model', array(), array(
//                'class' => 'Up2green\EducationBundle\Model\School'
//            ))
//            ->add('user', 'model', array(), array(
//                'class' => 'FOS\UserBundle\Propel\User'
//            ))
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
            ->add('user.username')
        ;
    }
}