<?php

namespace Trikoder\Repository;

use Trikoder\Model\Invoice;
use Trikoder\Service\InvoiceFactory;
use Trikoder\Helper\Price;
use PDO;
use DateTime;

/**
 * Repozitorij za fakturu
 */
class InvoiceRepository extends BaseRepository
{
    /** @var PDO */
    protected $pdo;

    /**
     *
     * @param PDO $pdo
     * @param CustomerRepository $customerRepo
     */
    public function __construct(PDO $pdo, CustomerRepository $customerRepo)
    {
        $this->pdo = $pdo;
        $this->customerRepo = $customerRepo;
    }

    /**
     * Vraća zadnje upisanu fakturu
     *
     * @return Invoice|null
     */
    public function findLastInsertedInvoice()
    {
        $statement = $this->pdo->prepare('SELECT * FROM invoice ORDER BY id DESC LIMIT 1');
        $statement->execute();
        $invoiceArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$invoiceArray) {
            return null;
        }

        return $this->createInvoiceFromArray($invoiceArray);
    }

    /**
     * Sprema fakturu
     *
     * @param  Invoice $invoice
     * @return Invoice
     */
    public function save(Invoice $invoice)
    {
        if ($invoice->getId()) {
            $stmt = $this->pdo->prepare(
                'UPDATE invoice SET unique_sequential_number = :uniqueSequentialNumber, date_of_creation = :dateOfCreation, due_date = :dueDate, total_brutto_amount = :totalBruttoAmount, total_tax_amount = :totalTaxAmount, currency = :currency, customer_id = :customerId WHERE id = :id'
            );
            $stmt->execute(
                array(
                    $invoice->getUniqueSequentialInvoiceNumber(), $invoice->getDateOfCreation()->format('Y-m-d H:i:s'), $invoice->getDueDate()->format('Y-m-d H:i:s'), $invoice->getTotalBruttoAmount()->getAmount(), $invoice->getTotalTaxAmount()->getAmount()->getAmount(), $invoice->getTotalBruttoAmount()->getCurrency(), $invoice->getCustomer()->getId(), $invoice->getId(),
                    )
            );
        } else {
            $stmt = $this->pdo->prepare(
                'INSERT INTO invoice (unique_sequential_number, date_of_creation, due_date, total_brutto_amount, total_tax_amount, currency, customer_id) VALUES(:uniqueSequentialNumber, :dateOfCreation, :dueDate, :totalBruttoAmount, :totalTaxAmount, :currency, :customerId)'
            );
            $stmt->execute(
                array(
                    ':uniqueSequentialNumber' => $invoice->getUniqueSequentialInvoiceNumber(), ':dateOfCreation' => $invoice->getDateOfCreation()->format('Y-m-d H:i:s'), ':dueDate' => $invoice->getDueDate()->format('Y-m-d H:i:s'), ':totalBruttoAmount' => $invoice->getTotalBruttoAmount()->getAmount(), ':totalTaxAmount' => $invoice->getTotalTaxAmount()->getAmount(), ':currency' => $invoice->getTotalBruttoAmount()->getCurrency(), ':customerId' => $invoice->getCustomer()->getId()
                    )
            );
        }

        $invoice->setId($this->pdo->lastInsertId());

        return $invoice;
    }

    /**
     * Pomoćna factory metoda koja stvara fakturu na temelju podataka iz baze
     *
     * @param  array $invoiceArray
     * @return Invoice
     */
    private function createInvoiceFromArray($invoiceArray)
    {
        $invoice = new Invoice();
        $currency = $invoiceArray['currency'];
        $invoice->setId($invoiceArray['id'])
                ->setDateOfCreation(new DateTime($invoiceArray['date_of_creation']))
                ->setDueDate(new DateTime($invoiceArray['due_date']))
                ->setCustomer($this->customerRepo->findOneById($invoiceArray['customer_id']))
                ->setUniqueSequentialInvoiceNumber($invoiceArray['unique_sequential_number'])
                ->setTotalBruttoAmount(new Price($invoiceArray['total_brutto_amount'], $currency))
                ->setTotalTaxAmount(new Price($invoiceArray['total_tax_amount'], $currency))
                ->setCurrency($currency);

        return $invoice;
    }
}
