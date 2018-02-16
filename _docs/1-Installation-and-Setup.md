# 2. Installation

## Table of contents

0. [Home](0-Home.md)
1. [Installation and Setup](1-Installation-and-Setup.md)
2. [Usage](2-Usage.md)

## Server Requirements

The Color package has a few system requirements:

```
- PHP >= 5.6
```

## Version Compatibility

| Color                        | Laravel                                                                                                             |
|:-----------------------------|:--------------------------------------------------------------------------------------------------------------------|
| ![Color v0.3.x][color_0_3_x] | ![Laravel v5.0][laravel_5_0] ![Laravel v5.1][laravel_5_1] ![Laravel v5.2][laravel_5_2] ![Laravel v5.3][laravel_5_3] |
| ![Color v0.4.x][color_0_4_x] | ![Laravel v5.4][laravel_5_4]                                                                                        |
| ![Color v1.x][color_1_x]     | ![Laravel v5.5][laravel_5_5]                                                                                        |
| ![Color v2.x][color_2_x]     | ![Laravel v5.6][laravel_5_6]                                                                                        |


[laravel_5_0]:  https://img.shields.io/badge/v5.0-supported-brightgreen.svg?style=flat-square "Laravel v5.0"
[laravel_5_1]:  https://img.shields.io/badge/v5.1-supported-brightgreen.svg?style=flat-square "Laravel v5.1"
[laravel_5_2]:  https://img.shields.io/badge/v5.2-supported-brightgreen.svg?style=flat-square "Laravel v5.2"
[laravel_5_3]:  https://img.shields.io/badge/v5.3-supported-brightgreen.svg?style=flat-square "Laravel v5.3"
[laravel_5_4]:  https://img.shields.io/badge/v5.4-supported-brightgreen.svg?style=flat-square "Laravel v5.4"
[laravel_5_5]:  https://img.shields.io/badge/v5.5-supported-brightgreen.svg?style=flat-square "Laravel v5.5"
[laravel_5_6]:  https://img.shields.io/badge/v5.6-supported-brightgreen.svg?style=flat-square "Laravel v5.6"

[color_0_3_x]: https://img.shields.io/badge/version-0.3.*-blue.svg?style=flat-square "Color v0.3.*"
[color_0_4_x]: https://img.shields.io/badge/version-0.4.*-blue.svg?style=flat-square "Color v0.4.*"
[color_1_x]:   https://img.shields.io/badge/version-1.*-blue.svg?style=flat-square "Color v1.*"
[color_2_x]:   https://img.shields.io/badge/version-2.*-blue.svg?style=flat-square "Color v2.*"

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/color`

## Laravel

### Setup

> **NOTE :** The package will automatically register itself if you're using Laravel `>= v5.5`, so you can skip this section.

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
// config/app.php

'providers' => [
    ...
    Arcanedev\Color\ColorServiceProvider::class,
],
```

(**Optional**) And for the Facades:

```php
// config/app.php

'aliases' => [
    ...
    'Color' => Arcanedev\Color\Facades\Color::class,
];
```
