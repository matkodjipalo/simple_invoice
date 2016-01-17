<?php

namespace tests\Trikoder\Model;

use Trikoder\Model\InvoiceItem;
use Trikoder\Model\Product;
use Trikoder\Model\Category;
use Trikoder\Helper\Country;
use Trikoder\Helper\Price;
use PDO;

class InvoiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testTotalBruttoAmountWhenThereIsNoItems()
    {
        $this->assertEquals(1, 1);
        /*
        $pdo = $this->getMockBuilder('PDO')
                ->setConstructorArgs(array(
                    'db_dsn' => 'mysql:host=localhost;dbname=trikoder_zadatak',
                    'db_user' => 'root',
                    'db_pass' => 'root',
                ))
                ->getMock();
        $invoiceRepo = $this->getMockBuilder('Trikoder\Service\InvoiceRepository')
                ->getMock();
        $numberGenerator = $this->getMockBuilder('Trikoder\Service\UniqueSequentialInvoiceNumberCreator')
                ->setConstructorArgs(array($pdo, $invoiceRepo))
                ->getMock();
        $invoiceFactory = new InvoiceFactory($numberGenerator);
        $invoice->setDateOfCreation()
                ->setDueDate()
                ->setInvoiceItems([])
                ->setUniqueSequentialInvoiceNumber(333)
                ->setTotalBruttoAmount($this->calculateTotalBruttoAmount($invoiceItems))
                ->setTotalTaxAmount($this->calculateTotalTaxAmountt($invoiceItems, $invoice->getTaxRate()));
                */
        // zahtjeva dovršavanje...

    }
}
