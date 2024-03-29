<?php

namespace Ronnie\TRA\Entities;

use Illuminate\Support\Collection;

class Customer
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $idType = null,
        public readonly ?string $id = null,
        public readonly ?string $mobile = null
    ) {
    }

    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'name' => ($this->name === 'n/a' || $this->name === 'NIL') ? null : $this->name,
            'id_type' => ($this->idType === 'n/a' || $this->idType === 'NIL') ? null : $this->idType,
            'id' => ($this->id === 'n/a' || $this->id === 'NIL') ? null : $this->id,
            'mobile' => ($this->mobile === 'n/a' || $this->mobile === 'NIL') ? null : $this->mobile
        ];
    }
}
