Usage
=====

The bundle usage, is the most simple of the universe (almost :sparkles:).

Add to your template:


```twig
{{ knp_menu_render('th3mouk.cms.siteplan.menu') }}
```

Congrats ! You're done ! :clap::tada:

This menu is powered by [KnpMenu](https://github.com/KnpLabs/KnpMenu)

Thanks to the [SiteSelector](https://github.com/sonata-project/SonataPageBundle/blob/master/Site/SiteSelectorInterface.php), this tag offers the possibility to use it on all your [sub-sites](https://sonata-project.org/bundles/page/2-2/doc/reference/multisite.html) without parameters or configuration. 

##Render

:exclamation: If you want to personalize the render, you can add the template option of the [KnpMenuBundle](https://github.com/KnpLabs/KnpMenuBundle), or a lot of others.
```twig
{{ knp_menu_render('th3mouk.cms.siteplan.menu', {template: 'AppBundle:Menu:plan_menu.html.twig'}) }}
```


Extends
=======

You probably want to add some of hybrid pages, personal process, or static controller's routes.

So this part is most interesting !

The [MenuPlanEvent](https://github.com/Th3Mouk/CMSSiteplanBundle/blob/master/Event/MenuPlanEvent.php) class provide two events:zap: during the building of the menu.

To add elements before and after the content generation.

##Quick guide

I know example is most efficient than explanation :grin:

First of all we need a listener to ours events:

```php
namespace AppBundle\EventListener;

use Th3Mouk\CMSSiteplanBundle\Event\MenuPlanEvent;

class MenuPlanListener
{
    /**
     * @param Th3Mouk\CMSSiteplanBundle\Event\MenuPlanEvent $event
     */
    public function onMenuAfterConfigure(MenuPlanEvent $event)
    {
        $menu = $event->getMenu();

        $menu = $menu->getChildren();
        $menu = current($menu);

        $menu->addChild('News', array('route' => 'app_news'));
    }
}
```

:exclamation: You can see a little trick to add News on the first element instead of the root element.

And to finish (seriously ? :scream:)

Declare your listener with the `kernel.event_listener` tag.
Bind an `event` to a class `method`.
 
```yml
services:
    app.plan.menu_listener:
        class: AppBundle\EventListener\MenuPlanListener
        tags:
          - { name: kernel.event_listener, event: th3mouk.cms.menu.event.extend.after, method: onMenuAfterConfigure }
```

###You're ready to change your world ! :earth_africa: