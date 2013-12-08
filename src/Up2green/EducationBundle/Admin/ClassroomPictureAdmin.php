<?php

namespace Up2green\EducationBundle\Admin;

use Doctrine\Common\Util\Debug;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

/**
 * Classroom picture admin class
 */
class ClassroomPictureAdmin extends Admin
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
        $pictureOptions = array('required' => false);

        /** @var \Up2green\EducationBundle\Entity\ClassroomPicture $subject */
        if (($subject = $this->getSubject()) && $subject->getPicture()) {
            $pictureOptions['help'] = '<img style="max-width:200px; max-height: 200px;" src="' . $subject->getPath() .'/'. $subject->getPicture() . '" />';
        }

        $formMapper
            ->add('classroom')
            ->add('student')
            ->add('program')
            ->add('pictureFile', 'file', $pictureOptions);
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
            ->add('classroom')
            ->add('student')
            ->add('program')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('classroom')
            ->add('student')
            ->add('program');
    }
}