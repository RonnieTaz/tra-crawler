<?php

namespace Ronnie\TRA\Entities;

use Illuminate\Support\Collection;

class InvoiceInfo
{
    public function __construct(
        private readonly string $serial,
        private readonly string $uin,
        private readonly float $totalTax,
        private readonly float $totalWithoutTax,
        private readonly float $taxA,
        private readonly float $totalWithTax
    ) {
    }

    public function toCollection(): Collection
    {
        $collection = collect();
        $collection->put('serial_no', $this->serial);
        $collection->put('uin', $this->uin);
        $collection->put('total_tax', $this->totalTax);
        $collection->put('total_without_tax', $this->totalWithoutTax);
        $collection->put('tax_A', $this->taxA);
        $collection->put('total_with_tax', $this->totalWithTax);

        return $collection;
    }

    public function toArray(): array
    {
        return $this->toCollection()->toArray();
    }
}
