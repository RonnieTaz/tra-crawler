<?php

declare(strict_types=1);

namespace Ronnie\TRA;

use Ronnie\TRA\Contracts\ResourceCrawler;
use Ronnie\TRA\Contracts\ResourceFetcher;
use Ronnie\TRA\Entities\Company;
use Ronnie\TRA\Entities\Customer;
use Ronnie\TRA\Entities\InvoiceInfo;
use Ronnie\TRA\Entities\Items;
use Ronnie\TRA\Entities\Receipt;
use Ronnie\TRA\Entities\ReceiptInfo;
use Ronnie\TRA\Enum\Constants;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

class Crawler implements ResourceCrawler
{
    public ResourceFetcher $fetcher;
    private bool $test = false;

    public function __construct(?ResourceFetcher $fetcher = null, ?array $options = [])
    {
        $timeout = $options['timeout'] ?? null;
        $this->fetcher = $fetcher ?? new Fetcher(timeout: $timeout ?? null);
    }

    public function setTestMode(bool $testMode): self
    {
        $this->test = $testMode;

        return $this;
    }

    public function setUri(string $uri): self
    {
        $this->fetcher->setUri($uri);

        return $this;
    }

    public function setCode(string $code, string $time): self
    {
        $this->fetcher->setUri(Constants::BASE_URL->value . "{$code}_$time");

        return $this;
    }

    public function setFetcher(ResourceFetcher $fetcher): self
    {
        $this->fetcher = $fetcher;

        return $this;
    }

    public function crawl(): Receipt
    {
        $this->fetcher->setTestMode($this->test);

        $crawler = new SymfonyCrawler($this->fetcher->load());

        $info = $crawler->filter('section#inv')->eq(0)->children();

        return new Receipt(
            info: $this->crawlReceipt($info),
            company: $this->crawlCompany($info),
            invoice: $this->crawlInvoice($info),
            customer: $this->crawlCustomer($info),
            items: $this->crawlItems($info)
        );
    }

    private function crawlCompany(SymfonyCrawler $crawler): Company
    {
        $company = $crawler->eq(1)->children()->eq(0)->children()->text();

        return new Company(
            $crawler->eq(0)->text(),
            search_from_end(
                $company,
                'MOBILE: ',
                -strlen(substr(
                    $company,
                    strpos($company, 'TIN:')
                ))
            ),
            search_from_end(
                $company,
                'TIN: ',
                -strlen(substr(
                    $company,
                    strpos($company, 'VRN:')
                ))
            ),
            search_from_end(
                $company,
                'VRN: ',
                -strlen(substr(
                    $company,
                    strpos($company, 'SERIAL NO:')
                ))
            ),
            search_from_end($company, 'TAX OFFICE: ')
        );
    }

    private function crawlInvoice(SymfonyCrawler $crawler): InvoiceInfo
    {
        $invoice = $crawler->eq(1)->children()->eq(0)->children()->text();
        $costs = $crawler->eq(7)->filter('table > tbody')->children();

        return new InvoiceInfo(
            search_from_end(
                $invoice,
                'SERIAL NO: ',
                -strlen(substr(
                    $invoice,
                    strpos($invoice, 'UIN:')
                ))
            ),
            search_from_end(
                $invoice,
                'UIN: ',
                -strlen(substr(
                    $invoice,
                    strpos($invoice, 'TAX OFFICE:')
                ))
            ),
            (float)str_replace(',', '', $costs->eq(2)->filter('td')->text()),
            (float)str_replace(',', '', $costs->eq(0)->filter('td')->text()),
            (float)str_replace(',', '', $costs->eq(1)->filter('td')->text()),
            (float)str_replace(',', '', $costs->eq(3)->filter('td')->text())
        );
    }

    private function crawlCustomer(SymfonyCrawler $crawler): Customer
    {
        $customer = $crawler->eq(2)->children()->text();

        return new Customer(
            search_from_end(
                $customer,
                'CUSTOMER NAME: ',
                -strlen(substr(
                    $customer,
                    strpos($customer, 'CUSTOMER ID TYPE:')
                ))
            ),
            search_from_end(
                $customer,
                'CUSTOMER ID TYPE: ',
                -strlen(substr(
                    $customer,
                    strpos($customer, 'CUSTOMER ID:')
                ))
            ),
            search_from_end(
                $customer,
                'CUSTOMER ID: ',
                -strlen(substr(
                    $customer,
                    strpos($customer, 'CUSTOMER MOBILE:')
                ))
            ),
            search_from_end(
                $customer,
                'CUSTOMER MOBILE: ',
            ),
        );
    }

    private function crawlReceipt(SymfonyCrawler $crawler): ReceiptInfo
    {
        $receipt = $crawler->eq(3)->children()->text();

        return new ReceiptInfo(
            search_from_end(
                $receipt,
                'RECEIPT NO: ',
                -strlen(substr(
                    $receipt,
                    strpos($receipt, 'Z NUMBER:')
                ))
            ),
            search_from_end(
                $receipt,
                'Z NUMBER: ',
                -strlen(substr(
                    $receipt,
                    strpos($receipt, 'RECEIPT DATE:')
                ))
            ),
            search_from_end(
                $receipt,
                'RECEIPT DATE: ',
                -strlen(substr(
                    $receipt,
                    strpos($receipt, 'RECEIPT TIME:')
                ))
            ),
            search_from_end(
                $receipt,
                'RECEIPT TIME: ',
            ),
        );
    }

    private function crawlItems(SymfonyCrawler $crawler): Items
    {
        $itemSource = $crawler->eq(6)->filter('table')->children('tbody')->children('tr');
        $collection = collect();

        $itemSource->each(function (SymfonyCrawler $node) use ($collection) {
            $filteredNode = $node->filter('td');
            $collection->add(collect([
                'product_name' => $filteredNode->eq(0)->text(),
                'quantity' => (int) $filteredNode->eq(1)->text(),
                'amount' => (float) str_replace(',', '', $filteredNode->eq(2)->text())
            ]));
        });

        return new Items($collection);
    }
}
