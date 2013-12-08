<?php

namespace Up2green\BlogBundle\Admin;

use Doctrine\Common\Util\Debug;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

/**
 * Article admin class
 */
class ArticleAdmin extends Admin
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
        if (($subject = $this->getSubject()) && $subject->getLogo()) {
            $formMapper
                ->add('logoFile', 'file', array(
                    'required' => false,
                    'help'     => '<img style="max-width:200px; max-height: 200px;" src="' . $subject->getPath() .'/'. $subject->getLogo() . '" />'
                ))
                ->add('removeLogoFile', 'checkbox', array('required' => false))
            ;
        } else {
            $formMapper->add('logoFile', 'file', array('required' => false));
        }

        $formMapper
            ->add('isActive', null, array('required' => false))
            ->add('translations', 'a2lix_translations_gedmo', array(
                'translatable_class' => 'Up2green\BlogBundle\Entity\Article',
                'fields' => array(
                    'title' => array(),
                    'summary' => array(
                        'attr' => array(
                            'class' => 'ckeditor'
                        )
                    ),
                    'description' => array(
                        'attr' => array(
                            'class' => 'ckeditor'
                        )
                    ),
                )
            ))
        ;
    }

    /**
     * @param \Up2green\BlogBundle\Entity\Article $object
     */
    public function prePersist($object)
    {
        if (null !== $object->getLogoFile()) {
            $this->uploader->markEntityToUpload($object, $object->getLogoFile());
        }
    }

    /**
     * @param \Up2green\BlogBundle\Entity\Article $object
     */
    public function preUpdate($object)
    {
        if ($object->getRemoveLogoFile()) {
            $object->setLogo(null);
        }

        if (null !== $object->getLogoFile()) {
            $this->uploader->markEntityToUpload($object, $object->getLogoFile());
        }
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('isActive')
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
            ->add('title')
            ->add('isActive')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}