<?php

namespace Ronnie\TRA\Entities;

use Illuminate\Support\Collection;

class Items
{
    public function __construct(private readonly Collection $items)
    {
    }

    public function toCollection(): Collection
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return $this->items->toArray();
    }
}
