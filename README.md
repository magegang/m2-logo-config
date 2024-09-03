# Module for Magento 2

[![Latest Stable Version](https://img.shields.io/packagist/v/magegang/module-logo-config.svg?style=flat-square)](https://packagist.org/packages/magegang/module-logo-config)
[![License: MIT](https://img.shields.io/github/license/ronangr1/m2-logo-config.svg?style=flat-square)](./LICENSE)
[![Packagist](https://img.shields.io/packagist/dt/magegang/module-logo-config.svg?style=flat-square)](https://packagist.org/packages/magegang/module-logo-config/stats)
[![Packagist](https://img.shields.io/packagist/dm/magegang/module-logo-config.svg?style=flat-square)](https://packagist.org/packages/magegang/module-logo-config/stats)

This module enables your marketing teams to manage your store logos throughout the year.

- [Setup](#setup)
    - [Composer installation](#composer-installation)
    - [Setup the module](#setup-the-module)
- [Documentation](#documentation)
- [Support](#support)
- [Authors](#authors)
- [License](#license)

## Setup

Magento 2 Open Source or Commerce edition is required.

###  Composer installation

Run the following composer command:

```
composer require magegang/module-logo-config
```

### Setup the module

Run the following magento command:

```
bin/magento setup:upgrade
```

## Documentation

* Go to `Content > Logo > Schedule`
* Add a logo

Note: a preference for `Magento\Theme\Block\Html\Header\Logo` is defined to implement the `IdentityInterface` pattern. So you won't need to clear the cache for your updated data to be taken into effect.

## Support

Raise a new [request](https://github.com/magegang/m2-logo-config/issues) to the issue tracker.

## Authors

- **ronangr1** - *Maintainer* - [![GitHub followers](https://img.shields.io/github/followers/ronangr1.svg?style=social)](https://github.com/ronangr1)
- **Contributors** - *Contributor* - [![GitHub contributors](https://img.shields.io/github/contributors/ronangr1/m2-systemconfigwhodidthislogger.svg?style=flat-square)](https://github.com/ronangr1/M2-SystemConfigWhoDidThisLogger/graphs/contributors)

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) details.

***That's all folks!***
