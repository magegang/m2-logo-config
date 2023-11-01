# Schedule logo on your online store

This module enables your marketing teams to manage your store logos throughout the year.

## Setup

```
# Create the vendor name directory and clone the module

cd app/code && mkdir Magegang && cd $_
git clone https://github.com/magegang/m2-logo-config LogoConfig

# Launch standard Magento commands

bin/magento se:up
bin/magento mo:en Magegang_LogoConfig
bin/magento ca:cl
```

## How to schedule a new logo

* Go to `Content > Logo > Schedule`
* Add a logo (respecting the fields defined in the form)
* Clear cache

Note: a preference for `Magento\Theme\Block\Html\Header\Logo` is defined to implement the `IdentityInterface` pattern. So you won't need to clear the cache for your updated data to be taken into effect.

## Requirements

* Magento 2
* PHP >= 8

## Maintainers

* [ronangr1](https://github.com/ronangr1)

## Support

If you have any problems using this module, please open an issue [here](https://github.com/magegang/m2-logo-config/issues/new).
