# Realtime Register RESTful API - PHP SDK

[![Codecov](https://codecov.io/gh/realtimeregister/realtimeregister-php/branch/master/graph/badge.svg?token=CWWIFWRKZC)](https://packagist.org/packages/realtimeregister/realtimeregister-php)
[![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/realtimeregister/realtimeregister-php/ci.yml?branch=master)](https://packagist.org/packages/realtimeregister/realtimeregister-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/realtimeregister/realtimeregister-php)](https://packagist.org/packages/realtimeregister/realtimeregister-php)
[![Packagist PHP Version Support](https://img.shields.io/packagist/v/realtimeregister/realtimeregister-php)](https://packagist.org/packages/realtimeregister/realtimeregister-php)
[![Packagist Downloads](https://img.shields.io/packagist/dt/realtimeregister/realtimeregister-php)](https://packagist.org/packages/realtimeregister/realtimeregister-php)

## Supported APIs

This SDK currently supports these APIs:

* [Domains API](https://dm.realtimeregister.com/docs/api/domains)
* [Hosts API](https://dm.realtimeregister.com/docs/api/hosts)
* [Customers API](https://dm.realtimeregister.com/docs/api/customers)
* [Contacts API](https://dm.realtimeregister.com/docs/api/contacts)
* [Notifications API](https://dm.realtimeregister.com/docs/api/notifications)
* [Providers API](https://dm.realtimeregister.com/docs/api/providers)
* [TLDs API](https://dm.realtimeregister.com/docs/api/tlds)
* [Processes API](https://dm.realtimeregister.com/docs/api/processes)
* [Certificates API](https://dm.realtimeregister.com/docs/api/ssl)

Are you missing functionality? Feel free to create an issue, or hit us up with a pull request.

## How to use (REST API)

```bash
composer require realtimeregister/realtimeregister-php
```

```php
<?php

use RealtimeRegister\RealtimeRegister;

$realtimeRegister = new RealtimeRegister('my-secret-api-key');

$realtimeRegister->contacts->list('johndoe');
```

## How to use (IsProxy)

The IsProxy interface offers the most efficient way to check domain name validity and availability. It reduces overhead by using a telnet based protocol that allows multiple checks to be made in parallel. The interface can be used most effectively by reusing existing sessions as much as possible, this will lower the overhead on session creation and authentication.

An example: 
```php
<?php

use RealtimeRegister\IsProxy;

$isProxy = new IsProxy('my-secret-api-key');

if ($result = $isProxy->check('example', 'com')) {
    if ($result->isAvailable()) {
        echo "{$result->getDomain()} is available.";
    } else {
        echo "{$result->getDomain()} is not available.";
    }
}

// example.com is available.
```

Or check multiple:
```php
<?php

use RealtimeRegister\IsProxy;

$isProxy = new IsProxy('my-secret-api-key');

foreach ($isProxy->checkMany('example', ['nl', 'com', 'net', 'org']) as $result) {
    echo $result->getDomain() . $result->isAvailable() ? ' ✅' : ' ❌';
}
// example.nl ✅
// example.com ❌
// example.net ✅
// example.org ✅
```

## How to contribute

Feel free to create a PR if you have any ideas for improvements. Or create an issue.

* When adding code, make sure to add tests for it (phpunit).
* Make sure the code adheres to our coding standards (use php-cs-fixer to check/fix).
* Also make sure PHPStan does not find any bugs.

```bash
vendor/bin/php-cs-fixer fix

vendor/bin/phpstan analyze

vendor/bin/phpunit --coverage-text
```

These tools will also run in GitHub actions on PR's and pushes on master.

## Attribution
This project is an adaptation of the excellent work done by [sandwave.io](https://github.com/sandwave-io/realtimeregister-php)
