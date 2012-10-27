<?php

namespace Up2green\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Admin menu
 */
class AdminMenu extends ContainerAware
{
    protected $factory;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @param Router  $router
     */
    public function createAdminMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('id' => 'main_navigation', 'class'=>'menu') ) );

        $help = $menu->addChild('Education', array('uri' => '#'));
        $help->setLinkAttributes(array('class'=>'sub main'));

        $help->addChild('School', array(
            'route' => 'Up2green_AdminBundle_School_list'
        ));

        return $menu;
    }
}
