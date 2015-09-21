<?php

namespace Th3Mouk\CMSSiteplanBundle\Menu;

use Knp\Menu\FactoryInterface;
use Sonata\PageBundle\Model\PageManagerInterface;
use Sonata\PageBundle\Site\SiteSelectorInterface;

class BasePlanBuilder
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var SiteSelectorInterface
     */
    protected $site_selector;

    /**
     * @var PageManagerInterface
     */
    protected $page_manager;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(
        FactoryInterface $factory,
        SiteSelectorInterface $site_selector,
        PageManagerInterface $page_manager
    ) {
        $this->factory = $factory;
        $this->site_selector = $site_selector;
        $this->page_manager = $page_manager;
    }

    public function createPlanMenu()
    {
        $menu = $this->factory->createItem('root');

        $this->generatePageMenu($menu);

        return $menu;
    }

    public function generatePageMenu($menu)
    {
        $site = $this->site_selector->retrieve();
        $page = $this->page_manager->getPageByUrl($site, '/');

        $menu->addChild($page->getName(), array(
            'route' => $page->getRouteName(),
            'routeParameters' => array('path' => $page->getUrl()),
        ));

        if (!$page) {
            return false;
        }

        $this->iterate($menu[$page->getName()], $page);
    }

    public function iterate($menu, $page)
    {
        foreach ($page->getChildren() as $page) {
            if ($page->isHybrid() || !$page->getUrl()) {
                continue;
            }

            $menu->addChild($page->getName(), array(
                'route' => $page->getRouteName(),
                'routeParameters' => array('path' => $page->getUrl()),
            ));

            if ($page->getChildren()) {
                $this->iterate($menu[$page->getName()], $page);
            }
        }
    }
}
