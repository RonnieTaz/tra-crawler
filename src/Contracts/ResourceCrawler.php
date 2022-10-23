<?php

namespace Ronnie\TRA\Contracts;

interface ResourceCrawler
{
    public function setUri(string $uri): ResourceCrawler;

    public function setFetcher(ResourceFetcher $fetcher): ResourceCrawler;
}
