<?php

use Ronnie\Tests\TestCase;
use Ronnie\TRA\Contracts\ResourceFetcher;
use Ronnie\TRA\Fetcher;

uses(TestCase::class);

beforeEach(function () {
    $fetcher = (new Fetcher())->setUri('https://www.google.com');
});

it('implements ResourceFetcher', function () {
    expect(new Fetcher())->toBeInstanceOf(ResourceFetcher::class);
});

it('returns a fetcher object when setUri is called and its value to match', function () {
    $fetcher = (new Fetcher())->setUri('https://www.google.com');
    expect($fetcher)->toBeObject()
        ->and($fetcher->getUri())->toBeString()
        ->and($fetcher->getUri())->toEqual('https://www.google.com');
});

it('has a defined Uri property if passed in constructor', function () {
    expect(new Fetcher())->toHaveProperty('uri')
        ->and((new Fetcher('https://www.google.com'))->getUri())->toBeString()
        ->and((new Fetcher('https://www.google.com'))->getUri())->toEqual('https://www.google.com');
});
