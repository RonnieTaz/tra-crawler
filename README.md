
![Logo](https://banners.beyondco.de/TRA%20Crawler.png?theme=light&packageManager=composer+require&packageName=ronnie%2Ftra-crawler&pattern=glamorous&style=style_1&description=PHP+library+to+crawl+TRA+EFD+receipts&md=1&showWatermark=0&fontSize=100px&images=receipt-tax)


# TRA Crawler

A PHP package for crawling TRA EFD receipts and returning its data as a collection, array or json.


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

