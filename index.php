<?php

require_once __DIR__.'/config/bootstrap.php';

use Trikoder\Service\Container;
use Trikoder\Helper\Price;
use Trikoder\Model\InvoiceItem;

echo 'TRIKODER APP TEST<br>';

$container = new Container($configuration);


$customerRepo = $container->getCustomerRepository();
$customer = $customerRepo->findOneById(1);

$productRepo = $container->getProductRepository();
$apples = $productRepo->findOneById(1);
$jutarnjiList = $productRepo->findOneById(2);

$invoiceItems = [];
$invoiceItems[] = new InvoiceItem($jutarnjiList, 2, new Price(0.96));
$invoiceItems[] = new InvoiceItem($apples, 1.77, new Price(1.23));

$invoiceRepo = $container->getInvoiceRepository();
$invoiceFactory = $container->getInvoiceFactory();
$invoice = $invoiceFactory->createInvoice($invoiceItems, $customer);
$invoice = $invoiceRepo->save($invoice);

$invoiceItemRepo = $container->getInvoiceItemRepository();
foreach ($invoiceItems as $invoiceItem) {
    $invoiceItemRepo->save($invoiceItem, $invoice->getId());
}

ddd($invoice, $invoiceFactory, $invoiceItems, $customer, $container);
