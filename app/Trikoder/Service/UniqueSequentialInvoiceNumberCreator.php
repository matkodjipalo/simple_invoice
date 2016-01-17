<?php

namespace Trikoder\Service;

use Trikoder\Repository\InvoiceRepository;
use PDO;

/**
 * Servis za generiranje jedinstvenog, sekvencijalnog broja fakture
 */
class UniqueSequentialInvoiceNumberCreator
{
    /** @var PDO */
    private $pdo;
    /** @var InvoiceRepository */
    private $invoiceRepository;

    /**
     * @param PDO $pdo
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(PDO $pdo, InvoiceRepository $invoiceRepository)
    {
        $this->pdo = $pdo;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Stvara jedinstveni, sekvencijalni broj fakture
     *
     * @return int
     */
    public function createUniqueSequentialInvoiceNumber()
    {
        $lastInvoice = $this->invoiceRepository->findLastInsertedInvoice();
        // Ako nema spremljenih faktura dodjeljujemo proizvoljni broj 1000
        if (!$lastInvoice) {
            return 1000;
        }

        return $lastInvoice->getUniqueSequentialInvoiceNumber() + 1;
    }
}
