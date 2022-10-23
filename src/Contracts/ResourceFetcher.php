<?php

namespace Ronnie\TRA\Contracts;

interface ResourceFetcher
{
    public function setUri(string $uri): ResourceFetcher;

    public function load(): string;
}
