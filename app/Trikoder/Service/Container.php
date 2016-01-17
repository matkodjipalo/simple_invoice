<?php

namespace Trikoder\Service;

use PDO;
use Trikoder\Repository\InvoiceRepository;
use Trikoder\Repository\InvoiceItemRepository;
use Trikoder\Repository\ProductRepository;
use Trikoder\Repository\CustomerRepository;

/**
 * Service container
 */
class Container
{
    private $configuration;
    private $pdo;

    private $invoiceRepository;
    private $invoiceItemRepository;
    private $productRepository;
    private $customerRepository;
    private $invoiceFactory;
    private $uniqueSequentialInvoiceNumberCreator;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if (!$this->pdo) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    /**
     * @return InvoiceRepository
     */
    public function getInvoiceRepository()
    {
        if ($this->invoiceRepository === null) {
            $this->invoiceRepository = new InvoiceRepository($this->getPDO(), $this->getCustomerRepository());
        }

        return $this->invoiceRepository;
    }

    /**
     * @return InvoiceItemRepository
     */
    public function getInvoiceItemRepository()
    {
        if ($this->invoiceItemRepository === null) {
            $this->invoiceItemRepository = new InvoiceItemRepository($this->getPDO());
        }

        return $this->invoiceItemRepository;
    }

    /**
     * @return ProductRepository
     */
    public function getProductRepository()
    {
        if ($this->productRepository === null) {
            $this->productRepository = new ProductRepository($this->getPDO());
        }

        return $this->productRepository;
    }

    /**
     * @return CustomerRepository
     */
    public function getCustomerRepository()
    {
        if ($this->customerRepository === null) {
            $this->customerRepository = new CustomerRepository($this->getPDO());
        }

        return $this->customerRepository;
    }

    /**
     * @return InvoiceFactory
     */
    public function getInvoiceFactory()
    {
        if ($this->invoiceFactory === null) {
            $this->invoiceFactory = new InvoiceFactory($this->getUniqueSequentialInvoiceNumberCreator());
        }

        return $this->invoiceFactory;
    }

    /**
     * @return UniqueSequentialInvoiceNumberCreator
     */
    public function getUniqueSequentialInvoiceNumberCreator()
    {
        if ($this->uniqueSequentialInvoiceNumberCreator === null) {
            $this->uniqueSequentialInvoiceNumberCreator = new UniqueSequentialInvoiceNumberCreator($this->getPDO(), $this->getInvoiceRepository());
        }

        return $this->uniqueSequentialInvoiceNumberCreator;
    }
}
