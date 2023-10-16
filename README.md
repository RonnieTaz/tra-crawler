
![Logo](https://banners.beyondco.de/TRA%20Crawler.png?theme=light&packageManager=composer+require&packageName=ronnie%2Ftra-crawler&pattern=glamorous&style=style_1&description=PHP+library+to+crawl+TRA+EFD+receipts&md=1&showWatermark=0&fontSize=100px&images=receipt-tax)


# TRA Crawler

A PHP package for crawling TRA receipts and returning its data as a collection, array or json.


## Badges

Add badges from somewhere like: [shields.io](https://shields.io/)

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

## Installation

Install TRA crawler with composer.

```bash
  composer require ronnie/tra-crawler
```

The project also make use of puppeteer to access JS content on the receipt.

```bash
  npm install puppeteer
```

## Authors

- [@RonnieTaz](https://www.github.com/RonnieTaz)


## Usage/Examples

### Plain PHP
When using this package in plain PHP, a simple setup like this can help you get started:

```php
  use Ronnie\TRA\Crawler;
  
  ...
  
  $crawler = new Crawler();
  // For URI or QR Scanned receipts you can use the URI method
  $receipt = $crawler->setUri($yourURI)->crawl();

  // For Physical receipt, Receipt verification code and the time is to be used in conjuction with the code method
  $receipt = $crawler->setCode($yourCode, $yourTime)->crawl();
```
Do note that the time (`$yourTime`) should be in `hhMMss` format (124453).

### Laravel / Dependency Injection
When using this package in a Laravel/Symfony Project or any project that has a DI container, a better solution would be to use the container to inject an instance of the `Ronnie\TRA\Crawler` class into whatever class or method you need. A singleton works best for such scenarios.

It is also possible to extend the `Ronnie\TRA\Crawler` class or write your own implementation as long as they obey the `Ronnie\TRA\Contracts\ResourceCrawler` contract/interface.

## Run Locally

Clone the project

```bash
  git clone https://github.com/RonnieTaz/tra-crawler
```

Go to the project directory

```bash
  cd tra-crawler
```

Install NPM dependencies

```bash
  npm install puppeteer
```

Install Composer dependencies

```bash
  composer install
```

Use CLI app to test output
```bash
  php bin/console app:test-output -i url -u the_receipt_url
```

Also, few sample receipts have been added to the project to simplify testing. Head over to `config.php` to set which sample you want to use.

