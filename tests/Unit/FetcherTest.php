<?php

use Ronnie\TRA\Contracts\ResourceFetcher;
use Ronnie\TRA\Fetcher;

it('implements ResourceFetcher', function () {
    $this->assertInstanceOf(ResourceFetcher::class, new Fetcher());
});

it('returns a fetcher object when setUri is called and its value to match', function () {
    $this->assertIsObject((new Fetcher())->setUri('https://www.google.com'));

    expect((new Fetcher())->setUri('https://www.google.com'))->toBeObject()
        ->and((new Fetcher())->setUri('https://www.google.com')->getUri())->toBeString()
        ->and((new Fetcher())->setUri('https://www.google.com')->getUri())->toEqual('https://www.google.com');
});

it('has a defined Uri property if passed in constructor', function () {
    $this->assertObjectHasAttribute('uri', new Fetcher());

    expect((new Fetcher('https://www.google.com'))->getUri())->toBeString()
        ->and((new Fetcher('https://www.google.com'))->getUri())->toEqual('https://www.google.com');
});
