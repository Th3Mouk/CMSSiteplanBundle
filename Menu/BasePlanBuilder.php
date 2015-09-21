<?php

namespace Th3Mouk\CMSSiteplanBundle\Menu;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Th3Mouk\CMSSiteplanBundle\Event\MenuPlanEvent;
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
     * @var EventDispatcherInterface
     */
    protected $event_dispatcher;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(
        FactoryInterface $factory,
        SiteSelectorInterface $site_selector,
        PageManagerInterface $page_manager,
        EventDispatcherInterface $event_dispatcher
    ) {
        $this->factory = $factory;
        $this->site_selector = $site_selector;
        $this->page_manager = $page_manager;
        $this->event_dispatcher = $event_dispatcher;
    }

    public function createPlanMenu()
    {
        $menu = $this->factory->createItem('root');

        $this->event_dispatcher->dispatch(
            MenuPlanEvent::BEFORE_GENERATION,
            new MenuPlanEvent($this->factory, $menu)
        );

        $this->generatePageMenu($menu);

        $this->event_dispatcher->dispatch(
            MenuPlanEvent::AFTER_GENERATION,
            new MenuPlanEvent($this->factory, $menu)
        );

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
