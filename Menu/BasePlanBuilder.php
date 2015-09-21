<?php

namespace Th3Mouk\CMSSiteplanBundle\Menu;

use Knp\Menu\FactoryInterface;
use Doctrine\ORM\EntityManager;

class BasePlanBuilder
{
    protected $factory;

    protected $em;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, EntityManager $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    public function createPlanMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Homepage', array('route' => 'app_home'));

        return $menu;
    }

    protected function getPagesRepository()
    {
        return $this->em->getRepository('Id4vMenuBundle:MenuItem');
    }
}
