<?php

declare(strict_types=1);

namespace Ronnie\TRA;

use Ronnie\TRA\Contracts\ResourceCrawler;
use Ronnie\TRA\Contracts\ResourceFetcher;
use Ronnie\TRA\Enum\Constants;

class Crawler implements ResourceCrawler
{
    public ResourceFetcher $fetcher;

    public function __construct(?ResourceFetcher $fetcher = null)
    {
        $this->fetcher = $fetcher ?? new Fetcher();
    }

    public function setUri(string $uri): self
    {
        $this->fetcher->setUri($uri);

        return $this;
    }

    public function setFetcher(ResourceFetcher $fetcher): self
    {
        $this->fetcher = $fetcher;

        return $this;
    }

    public function crawl(?string $uri = null, ?string $code = null): string
    {
        !is_null($uri) && $this->setUri($uri);

        !is_null($code) && $this->setUri(Constants::BASE_URL->value . $code);

        return $this->fetcher->load();
    }
}
