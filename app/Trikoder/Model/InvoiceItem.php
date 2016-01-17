<?php

namespace Trikoder\Model;

use Trikoder\Helper\Price;

/**
 * Stavka fakture
 */
class InvoiceItem
{
    /** @var int */
    private $id;

    /** @var Product */
    private $product;

    /** @var int */
    private $amountOfProduct;

    /** @var Price */
    private $itemPrice;

    /**
     * @param Product $product
     * @param float $amountOfProduct
     * @param Price $itemPrice
     */
    public function __construct(Product $product, $amountOfProduct, Price $itemPrice)
    {
        $this->product = $product;
        $this->amountOfProduct = $amountOfProduct;
        $this->itemPrice = $itemPrice;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getAmountOfProduct()
    {
        return $this->amountOfProduct;
    }

    /**
     * @return Price
     */
    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    /**
     * @return string
     */
    public function getItemPriceCurrency()
    {
        return $this->itemPrice->getCurrency();
    }

    /**
     * Vraća ukupnu cijenu stavke
     *
     * @return Price
     */
    public function getTotalPrice()
    {
        return $this->itemPrice->multiplyWith($this->amountOfProduct);
    }
}
