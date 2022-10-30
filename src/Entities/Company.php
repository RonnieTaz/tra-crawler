<?php

namespace Ronnie\TRA\Entities;

use Illuminate\Support\Collection;

class Company
{
    public function __construct(
        private readonly string $name,
        private readonly string $mobile,
        private readonly string $tin,
        private readonly string $vrn,
        private readonly string $taxOffice
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
