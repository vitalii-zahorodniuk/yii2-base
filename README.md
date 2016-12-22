Base tools package for yii2
=======================

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-packagist]

This extension:
- has a user-component with extended methods to check user rights

Installation
------------

1.  The preferred way to install this extension is through [composer](http://getcomposer.org/download/), run:
    ```bash
    php composer.phar require --prefer-dist xz1mefx/yii2-base "dev-master"
    ```

1.  Override components (*if need*) in config file:
    ```php
    'user' => [
        'class' => \xz1mefx\base\web\User::className(),
    ],
    ```

1.  [*not necessary*] If you use [`iiifx-production/yii2-autocomplete-helper`][link-autocomplete-extension] you need to run:
    ```bash
    composer autocomplete
    ```

[ico-version]: https://img.shields.io/github/release/xz1mefx/yii2-base.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-downloads]: https://img.shields.io/packagist/dt/xz1mefx/yii2-base.svg

[link-packagist]: https://packagist.org/packages/xz1mefx/yii2-base
[link-adminlte-extension]: https://github.com/xZ1mEFx/yii2-adminlte
[link-autocomplete-extension]: https://github.com/iiifx-production/yii2-autocomplete-helper
