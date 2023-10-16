<?php

namespace Ronnie\TRA\Entities;

use Illuminate\Support\Collection;

class Company
{
    public function __construct(
        public readonly string $name,
        public readonly string $mobile,
        public readonly string $tin,
        public readonly string $vrn,
        public readonly string $taxOffice
    ) {
    }

    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'mobile' => $this->mobile,
            'tin' => $this->tin,
            'vrn' => $this->vrn,
            'tax_office' => $this->taxOffice
        ];
    }
}
