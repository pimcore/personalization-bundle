# Installation

## Installation Process

Install bundle via composer:
```bash 
composer require pimcore/personalization-bundle
```

Enable bundle in `config/bundles.php`:
```php
return [
    ...
    Pimcore\Bundle\PersonalizationBundle\PimcorePersonalizationBundle::class => ['all' => true],
    ...
];
```

Install bundle via console:
```bash
bin/console pimcore:bundle:install PimcorePersonalizationBundle
```

#### Config
:::info
By default, targeting would be disabled. To enable it, you can either use the cookie `pimcore_targeting_enabled=1` or set the following config:
:::

```yaml
pimcore_personalization:
    targeting:
        enabled: true 
```

## Uninstallation

Before uninstalling the bundle, the `Target Group` references must be removed from DataObject classes, Custom services and Ecommerce Pricing Rules manually.