<?php

use Ronnie\TRA\Contracts\ResourceCrawler;
use Ronnie\TRA\Contracts\ResourceFetcher;
use Ronnie\TRA\Crawler;

it('implements ResourceCrawler', function () {
    expect(new Crawler())->toBeInstanceOf(ResourceCrawler::class);
});

it('has property of fetcher', function () {
    expect(new Crawler())->toHaveProperty('fetcher');
});

test('property of fetcher is of instance ResourceFetcher', function () {
    expect((new Crawler())->fetcher)->toBeInstanceOf(ResourceFetcher::class);
});
