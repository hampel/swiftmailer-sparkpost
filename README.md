# Swiftmailer SparkPost Driver

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hampel/swiftmailer-sparkpost.svg?style=flat-square)](https://packagist.org/packages/hampel/swiftmailer-sparkpost)
[![Total Downloads](https://img.shields.io/packagist/dt/hampel/swiftmailer-sparkpost.svg?style=flat-square)](https://packagist.org/packages/hampel/swiftmailer-sparkpost)
[![Open Issues](https://img.shields.io/github/issues-raw/hampel/swiftmailer-sparkpost.svg?style=flat-square)](https://github.com/hampel/swiftmailer-sparkpost/issues)
[![License](https://img.shields.io/packagist/l/hampel/swiftmailer-sparkpost.svg?style=flat-square)](https://packagist.org/packages/hampel/swiftmailer-sparkpost)

By [Simon Hampel](mailto:simon@hampelgroup.com)

## Description

Standalone implementation of Laravel's SparkPost Mail Driver from 
[illuminate/mail](https://github.com/illuminate/mail) - provides a Swift Mailer v6 implementation for SparkPost.

This package is inspired by: https://github.com/vemcogroup/laravel-sparkpost-driver which uses the SparkPost mail
driver from Laravel 5.8.x

## Installation

You can install the package via composer:

```bash
composer require hampel/swiftmailer-sparkpost
```

## Usage

The SparkPost options available are defined in the API: 
[SparkPost options](https://developers.sparkpost.com/api/transmissions/#header-request-body)

```php

$sparkpostOptions = [
	'options' => [
		'open_tracking' => false,
		'click_tracking' => true,
		'transactional' => true,
	],
	'campaign_id' => 'foo',
];

$transport = new SparkPostTransport(
	new GuzzleHttp\Client, 
	'MYSPARKPOSTAPIKEY', 
	$sparkpostOptions
);

// create a new Swift_Message
$message = ...

$result = $transport->send($message);

```
