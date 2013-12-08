<?php

namespace Up2green\ReforestationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Organization admin class
 */
class OrganizationAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('url')
            ->add('isActive', 'checkbox')
            ->add('translations', 'a2lix_translations_gedmo', array(
                'translatable_class' => 'Up2green\ReforestationBundle\Entity\Organization',
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
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('url')
            ->add('isActive')
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
            ->add('url')
            ->add('isActive')
        ;
    }
}