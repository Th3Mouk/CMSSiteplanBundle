CMS Site Plan Bundle
====================

This [Symfony](http://symfony.com/) bundle providing a site plan for your website, based on [SonataPageBundle](https://github.com/sonata-project/SonataPageBundle)

The aim is to simplify the website plan generation this the SonataPageBundle.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/36d9ec0e-e8a0-4fab-b077-2ba1b4f85019/mini.png)](https://insight.sensiolabs.com/projects/36d9ec0e-e8a0-4fab-b077-2ba1b4f85019) [![Latest Stable Version](https://poser.pugx.org/th3mouk/cms-siteplan-bundle/v/stable)](https://packagist.org/packages/th3mouk/cms-siteplan-bundle) [![Total Downloads](https://poser.pugx.org/th3mouk/cms-siteplan-bundle/downloads)](https://packagist.org/packages/th3mouk/cms-siteplan-bundle) [![Latest Unstable Version](https://poser.pugx.org/th3mouk/cms-siteplan-bundle/v/unstable)](https://packagist.org/packages/th3mouk/cms-siteplan-bundle) [![License](https://poser.pugx.org/th3mouk/cms-siteplan-bundle/license)](https://packagist.org/packages/th3mouk/cms-siteplan-bundle)

## Installation

`php composer.phar require th3mouk/cms-siteplan-bundle 1.0.x-dev`

Add to the `appKernel.php`:

```
new Th3Mouk\CMSSiteplanBundle\Th3MoukCMSSiteplanBundle(),
```

## Usage

```
{{ knp_menu_render('th3mouk.cms.siteplan.menu') }}
```

The documentation is available [here](/Resources/doc/index.md)

For more understanding, refer to the [KnpMenuBundle Documentation](http://symfony.com/doc/current/bundles/KnpMenuBundle/index.html)

## Please

Feel free to improve this bundle.
