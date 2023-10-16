<?php

namespace Ronnie\TRA\Entities;

class Receipt
{
    public function __construct(
        public readonly ReceiptInfo $info,
        public readonly Company $company,
        public readonly InvoiceInfo $invoice,
        public readonly Customer $customer,
        public readonly Items $items
    ) {
    }
}
