<?php

namespace Trikoder\Service;

use Trikoder\Model\Invoice;
use Trikoder\Model\Customer;
use Trikoder\Helper\Price;
use Trikoder\Repository\CustomerRepository;

/**
 * Factory servis za stvaranje fakture
 */
class InvoiceFactory
{
    /** @var UniqueSequentialInvoiceNumberCreator */
    private $invoiceNumberCreator;

    /** @var Price */
    private $totalBrutto;

    /**
     * @param UniqueSequentialInvoiceNumberCreator $invoiceNumberCreator
     */
    public function __construct(UniqueSequentialInvoiceNumberCreator $invoiceNumberCreator)
    {
        $this->invoiceNumberCreator = $invoiceNumberCreator;
    }

    /**
     * Stvara fakturu
     *
     * @param  array $invoiceItems
     * @param  Customer $customer
     * @return Invoice
     */
    public function createInvoice(array $invoiceItems, Customer $customer)
    {
        $invoice = new Invoice();
        $invoice->setDateOfCreation()
                ->setDueDate()
                ->setCustomer($customer)
                ->setInvoiceItems($invoiceItems)
                ->setUniqueSequentialInvoiceNumber($this->invoiceNumberCreator->createUniqueSequentialInvoiceNumber())
                ->setTotalBruttoAmount($this->calculateTotalBruttoAmount($invoiceItems))
                ->setTotalTaxAmount($this->calculateTotalTaxAmountt($invoiceItems, $invoice->getTaxRate()));

        return $invoice;
    }

    /**
     * Klakulira totalni brutto
     *
     * @param  array  $invoiceItems
     * @return Price
     */
    private function calculateTotalBruttoAmount(array $invoiceItems)
    {
        if (!empty($this->totalBrutto)) {
            return $this->totalBrutto;
        }

        $this->totalBrutto = new Price(0);
        foreach ($invoiceItems as $invoiceItem) {
            $this->totalBrutto->add($invoiceItem->getTotalPrice());
        }

        return $this->totalBrutto;
    }

    /**
     * Klakulira ukupni iznos poreza
     *
     * @param  array  $invoiceItems
     * @param  float $taxRate
     * @return Price
     */
    private function calculateTotalTaxAmountt(array $invoiceItems, $taxRate)
    {
        $totalBrutto = clone $this->calculateTotalBruttoAmount($invoiceItems);

        return $totalBrutto->multiplyWith($taxRate);
    }
}
