<?php

namespace Up2green\EducationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

/**
 * Classroom admin class
 */
class ClassroomAdmin extends Admin
{
    /**
     * @var UploadableManager
     */
    protected $uploader;

    /**
     * @param UploadableManager $uploader
     */
    public function setUploader(UploadableManager $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var \Up2green\BlogBundle\Entity\Article $subject */
        if (($subject = $this->getSubject()) && $subject->getPicture()) {
            $formMapper
                ->add('pictureFile', 'file', array(
                    'required' => false,
                    'help'     => '<img style="max-width:200px; max-height: 200px;" src="' . $subject->getPath() .'/'. $subject->getPicture() . '" />'
                ))
                ->add('removePictureFile', 'checkbox', array('required' => false))
            ;
        } else {
            $formMapper->add('pictureFile', 'file', array('required' => false));
        }

        $formMapper
            ->add('name')
            ->add('year')
            ->add('description')
            ->add('school')
            ->add('user')
            ->add('partner', null, array(
                'required' => false
            ))
        ;
    }

    /**
     * @param mixed $object
     */
    public function prePersist($object)
    {
        if (null !== $object->getPictureFile()) {
            $this->uploader->markEntityToUpload($object, $object->getPictureFile());
        }
    }

    /**
     * @param mixed $object
     */
    public function preUpdate($object)
    {
        if ($object->getRemovePictureFile()) {
            $object->setPicture(null);
        }

        if (null !== $object->getPictureFile()) {
            $this->uploader->markEntityToUpload($object, $object->getPictureFile());
        }
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
            ->add('user')
            ->add('partner')
            ->add('createdAt')
            ->add('updatedAt')
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
            ->add('partner')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}