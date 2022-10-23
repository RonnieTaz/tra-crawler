<?php

declare(strict_types=1);

namespace Ronnie\TRA;

use Ronnie\TRA\Contracts\ResourceFetcher;
use Spatie\Browsershot\Browsershot;

class Fetcher implements ResourceFetcher
{
    private string $uri;

    public function __construct(?string $uri = null)
    {
        !is_null($uri) && $this->uri = $uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public function load(): string
    {
        return Browsershot::url($this->uri)->bodyHtml();
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function jumps(): array
    {
        return Browsershot::url($this->uri)->triggeredRequests();
    }
}
