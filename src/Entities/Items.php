<?php

namespace Ronnie\TRA\Entities;

use Illuminate\Support\Collection;

class Items
{
    /**
     * @param Collection<Collection> $items
     */
    public function __construct(public readonly Collection $items)
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
