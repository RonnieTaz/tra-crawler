<?php

declare(strict_types=1);

namespace Ronnie\TRA;

use Ronnie\TRA\Contracts\ResourceFetcher;
use Spatie\Browsershot\Browsershot;

class Fetcher implements ResourceFetcher
{
    private string $uri;
    private bool $test = false;
    private int $timeout = 30;
    private array $config;

    public function __construct(?string $uri = null, ?int $timeout = null)
    {
        $this->config = include __DIR__ . '/config.php';
        !is_null($uri) && $this->uri = $uri;
        !is_null($timeout) && $this->timeout = $timeout;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public function setTestMode(bool $testMode): self
    {
        $this->test = $testMode;

        return $this;
    }

    public function load(): string
    {
        if ($this->test) {
            return Browsershot::html(file_get_contents($this->config['test_file']))->bodyHtml();
        }
        return Browsershot::url($this->uri)->timeout($this->timeout)->bodyHtml();
    }

    public function getUri(): string
    {
        return $this->uri;
    }
}
