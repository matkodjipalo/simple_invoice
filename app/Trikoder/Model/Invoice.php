<?php

namespace Trikoder\Model;

use Trikoder\Helper\Price;
use DateTime;
use DateInterval;

/**
 * Faktura
 */
class Invoice
{
    /** @var int */
    private $id;

    /** @var InvoiceItem[] */
    private $invoiceItems;

    /** @var int */
    private $uniqueSequentialInvoiceNumber;

    /** @var DateTime */
    private $dateOfCreation;

    /** @var DateTime */
    private $dueDate;

    /** @var Price */
    private $totalBruttoAmount;

    /** @var Price */
    private $totalTaxAmount;

    /** @var string */
    private $currency;

    /** @var Customery */
    private $customer;

    /**
     * @return int|null
     */
    public function getId()
    {
        return !empty($this->id) ? $this->id : null;
    }

    /**
     * @return int
     */
    public function getUniqueSequentialInvoiceNumber()
    {
        return $this->uniqueSequentialInvoiceNumber;
    }

    /**
     * @return DateTime
     */
    public function getDateOfCreation()
    {
        return $this->dateOfCreation;
    }

    /**
     * @return DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return Price
     */
    public function getTotalBruttoAmount()
    {
        return $this->totalBruttoAmount;
    }

    /**
     * @return Price
     */
    public function getTotalTaxAmount()
    {
        return $this->totalTaxAmount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Vraća iznos poreza
     *
     * @return float
     */
    public function getTaxRate()
    {
        return 0.25;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setInvoiceItems(array $invoiceItems)
    {
        $this->invoiceItems = $invoiceItems;
        return $this;
    }

    public function setUniqueSequentialInvoiceNumber($uniqueSequentialInvoiceNumber)
    {
        $this->uniqueSequentialInvoiceNumber = $uniqueSequentialInvoiceNumber;
        return $this;
    }

    public function setDateOfCreation(DateTime $dt = null)
    {
        $this->dateOfCreation = $dt ?: new DateTime();
        return $this;
    }

    /**
     * Datum isteka fakture.
     *
     * Neka je odlučeno da to bude 10 dana nakone kreiranja iste
     */
    public function setDueDate()
    {
        if (!$this->dateOfCreation) {
            $this->setDateOfCreation();
        }
        $this->dueDate = $this->dateOfCreation->add(new DateInterval('P10D'));

        return $this;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function setTotalBruttoAmount(Price $totalBruttoAmount)
    {
        $this->totalBruttoAmount = $totalBruttoAmount;
        return $this;
    }

    public function setTotalTaxAmount(Price $totalTaxAmount)
    {
        $this->totalTaxAmount = $totalTaxAmount;
        return $this;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
}
