# Passport Visa API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/salamwaddah/passport-visa-api.svg?style=flat-square)](https://packagist.org/packages/salamwaddah/passport-visa-api)
[![Total Downloads](https://img.shields.io/packagist/dt/salamwaddah/passport-visa-api.svg?style=flat-square)](https://packagist.org/packages/salamwaddah/passport-visa-api)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

An unofficial passportindex.org API - supports [199 passports](src/countries.csv)

## Showcase website

- [Visa requirements per passport](https://salamwaddah.com/tools/visa-free/passport/ma)

## Installation

You can install the package via composer:

```bash
composer require salamwaddah/passport-visa-api
```

## Usage

You can get all the visa requirements for a passport by using the `get()` method.

```php
require_once __DIR__ . '/../vendor/autoload.php';

$passport = \SalamWaddah\PassportVisa\Passport::make('ma');

$passport->get();
// [
//     "visa-free" => ["tr", etc...],
//     "visa-on-arrival" => ["lb", etc...],
//     "electronic-travel-authorization" => ["kr", etc...],
//     "e-visa" => ["jo", etc...],
//     "visa-required" => ["gb", etc...],
//     "not-admitted" => [],
//     "covid-ban" => [],
// ]
```

Alternatively you can get the visa requirements for a passport by using the methods:

- `listVisaFree()`
- `listVisaOnArrival()`
- `listEta()`
- `listEVisa()`
- `listVisaRequired()`
- `listNotAdmitted()`
- `listCovidBan()`

```php
// list of visa free countries for your $passport
$passport->listVisaFree(); // returns ["tr", etc...]

// list of countries which do not admit your $passport
$passport->listNotAdmitted(); // returns []
```

## Caching

This library does not cache the results, you can use your own caching mechanism to avoid unnecessarily calling passportindex.org everytime. A recommended TTL for your cache is 1 day.