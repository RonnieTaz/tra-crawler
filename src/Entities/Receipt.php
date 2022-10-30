<?php

namespace Ronnie\TRA\Entities;

use DateTimeImmutable;
use Illuminate\Support\Collection;

class Receipt
{
    public function __construct(
        private readonly string $receiptNumber,
        private readonly string $zNumber,
        private readonly string $date,
        private readonly string $time,
    ) {
    }

    public function toCollection(): Collection
    {
        $collection = collect();
        $collection->put('receipt_number', $this->receiptNumber);
        $collection->put('z_number', $this->zNumber);
        $collection->put('datetime', DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "$this->date $this->time"));

        return $collection;
    }

    public function toArray(): array
    {
        return $this->toCollection()->toArray();
    }
}
