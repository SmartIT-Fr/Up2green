<?php

namespace Up2green\ReforestationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

/**
 * Partner logo admin class
 */
class PartnerLogoAdmin extends Admin
{
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
        $options = array('required' => false);

        /** @var \Up2green\ReforestationBundle\Entity\PartnerLogo $subject */
        if (($subject = $this->getSubject()) && $subject->getSrc()) {
            $options['help'] = '<img style="max-width:200px; max-height: 200px;" src="' . $subject->getPath() .'/'. $subject->getSrc() . '" />';
        }

        $formMapper
            ->add('partner')
            ->add('href')
            ->add('srcFile', 'file', $options)
        ;
    }

    /**
     * @param mixed $object
     */
    public function prePersist($object)
    {
        if (null !== $object->getSrcFile()) {
            $this->uploader->markEntityToUpload($object, $object->getSrcFile());
        }
    }

    /**
     * @param mixed $object
     */
    public function preUpdate($object)
    {
        if (null !== $object->getSrcFile()) {
            $this->uploader->markEntityToUpload($object, $object->getSrcFile());
        }
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('partner')
            ->add('src')
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
            ->add('src')
            ->add('href')
        ;
    }
}