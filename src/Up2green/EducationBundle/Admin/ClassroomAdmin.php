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
            ->add('fos_user')
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
            ->add('fos_user')
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
            ->add('fos_user')
        ;
    }
}