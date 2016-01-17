<?php

namespace Trikoder\Repository;

use Trikoder\Model\InvoiceItem;
use PDO;

/**
 * Repozitorij za stavku fakture
 */
class InvoiceItemRepository extends BaseRepository
{
    /**
     * Sprema stavku fakture
     *
     * @param  InvoiceItem $item
     * @param  int $invoiceId
     * @return InvoiceItem
     */
    public function save(InvoiceItem $item, $invoiceId)
    {
        if ($item->getId()) {
            $stmt = $this->pdo->prepare(
                'UPDATE invoice_item SET invoice_id = :invoiceId, product_id = :productId, amount_of_product = :amountOfProduct, item_price = :itemPrice, item_price_currency = :itemPriceCurrency WHERE id = :id'
            );
            $stmt->execute(
                array(
                    $invoiceId, $item->getProduct()->getId(), $item->getAmountOfProduct(), $item->getItemPrice()->getAmount(), $item->getItemPriceCurrency(), $item->getId(),
                    )
            );
        } else {
            $stmt = $this->pdo->prepare(
                'INSERT INTO invoice_item (invoice_id, product_id, amount_of_product, item_price, item_price_currency) VALUES(:invoiceId, :productId, :amountOfProduct, :itemPrice, :itemPriceCurrency)'
            );
            $stmt->execute(
                array(
                    ':invoiceId' => $invoiceId, ':productId' => $item->getProduct()->getId(), ':amountOfProduct' => $item->getAmountOfProduct(), ':itemPrice' => $item->getItemPrice()->getAmount(), ':itemPriceCurrency' => $item->getItemPriceCurrency()
                )
            );
        }

        $item->setId($this->pdo->lastInsertId());

        return $item;
    }
}
