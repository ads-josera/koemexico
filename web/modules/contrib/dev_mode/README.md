# Development Mode

## Introduction
Development mode makes it easy to enable developer friendly settings
on your Drupal site, so you don't have to constantly clear the cache
and/or hard-reload your browser.

**Enable this module and it will:**
* Disable twig caching.
* Turn on twig template suggestions.
* Disable most Drupal caches.
* Disable JS and CSS aggregation.
* Disable browser level caching.
* Turn on verbose error logging.

**Disable this module and it will:**
* Restore your previous settings.

## Settings file
Module will attempt to write to settings.php, but if not writeable,
please add the following to the end of settings.php file:

```php
/**
* Development mode settings.
*/
if (file_exists($app_root . '/modules/contrib/dev_mode/settings.dev_mode.php')) {
  include $app_root . '/modules/contrib/dev_mode/settings.dev_mode.php';
}
```

## Install
* Enable this module to activate development mode on your Drupal site.
* Check logs after install to insure all went well.

## Uninstall
* Disable this module to deactivate development mode.
* Check logs after install to insure all went well.

## Configuration
* No user configuration options are available. Once the module is installed
its active.
* When the module is enabled, it remembers your performance and logging
settings before changing them.
* When the module is disabled, it will restore your settings.

## Maintainers

George Anderson (geoanders)
https://www.drupal.org/u/geoanders
