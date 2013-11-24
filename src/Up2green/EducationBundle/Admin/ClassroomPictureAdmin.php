<?php

namespace Up2green\EducationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Classroom picture admin class
 */
class ClassroomPictureAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $pictureOptions = array(
            'label'    => 'form.classroom_picture_type.picture',
            'required' => false,
        );

        /** @var \Up2green\EducationBundle\Entity\ClassroomPicture $subject */
        if (($subject = $this->getSubject()) && $subject->getPicture()) {
            $pictureOptions['help_inline'] = '<img style="max-width:200px; max-height: 200px;" src="' . $subject->getPicture() . '" />';
        }

        $formMapper
            ->add('student', null, array(
                'label' => 'form.classroom_picture_type.student'
            ))
            ->add('program', null, array(
                'label' => 'form.classroom_picture_type.program',
            ))
            ->add('classroom', null, array(
                'label' => 'form.classroom_picture_type.program'
            ))
            ->add('picture', 'file', $pictureOptions);
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('student')
            ->add('program')
            ->add('classroom.school')
            ->add('classroom')
            ->add('classroom.year');
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('student')
            ->add('program')
            ->add('classroom.school')
            ->add('classroom')
            ->add('classroom.year');
    }
}