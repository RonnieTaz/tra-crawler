<?php

namespace Ronnie\TRA\Entities;

use DateTimeImmutable;
use Illuminate\Support\Collection;

class ReceiptInfo
{
    public function __construct(
        public readonly string $receiptNumber,
        public readonly string $zNumber,
        public readonly string $date,
        public readonly string $time,
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
