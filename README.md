
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

Create an `index.php` file at the root of the project and add the following codes:
```php
    <?php

    use Ronnie\TRA\Crawler;

    require_once __DIR__ . '/vendor/autoload.php';

    $url = $_GET['url'] ?? null;
    $code = $_GET['code'] ?? null;
    $time = $_GET['time'] ?? null;

    $crawler = new Crawler();

    if (!is_null($url)) {
        dump($crawler->setUri($url)->crawl());
    } elseif (!is_null($code) && !is_null($time)) {
        dump($crawler->setCode($code, $time)->crawl());
    } else {
        echo "No url given";
    }
```

Feel free to change the file according to your needs. Then just run the `index.php` in a web server.
## Contributing

Contributions are always welcome!

See `contributing.md` for ways to get started.

Please adhere to this project's `code of conduct`.
