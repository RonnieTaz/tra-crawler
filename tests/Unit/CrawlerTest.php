<?php

use Ronnie\TRA\Contracts\ResourceCrawler;
use Ronnie\TRA\Contracts\ResourceFetcher;
use Ronnie\TRA\Crawler;

it('implements ResourceCrawler', function () {
    $this->assertInstanceOf(ResourceCrawler::class, new Crawler());
});

it('has property of fetcher', function () {
    $this->assertClassHasAttribute('fetcher', Crawler::class);
});

test('property of fetcher is of instance ResourceFetcher', function () {
    $this->assertInstanceOf(ResourceFetcher::class, (new Crawler())->fetcher);
});
