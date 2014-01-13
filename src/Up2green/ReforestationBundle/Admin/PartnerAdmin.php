<?php

namespace Up2green\ReforestationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Partner admin class
 */
class PartnerAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $query = $this->modelManager
            ->getEntityManager('Up2green\\UserBundle\\Entity\\User')
            ->createQueryBuilder('u')
            ->select('u')
            ->from('Up2greenUserBundle:User', 'u')
            ->leftJoin('u.partner', 'p')
            ->where('p IS NULL')
            ->orderBy('u.username', 'ASC')
        ;

        $formMapper
            ->with('Informations générales')
                ->add('user', null, array(
                    'query_builder' => $query
                ))
                ->add('title')
                ->add('summary')
                ->add('description')
                ->add('url')
                ->add('certificate')
            ->end()
            ->with('Page personalisée')
                ->add('pageTitle')
                ->add('page')
            ->end()
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('title')
            ->add('url')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user')
            ->add('title')
            ->add('url')
        ;
    }
}