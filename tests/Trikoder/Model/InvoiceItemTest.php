<?php

namespace tests\Trikoder\Model;

use Trikoder\Model\InvoiceItem;
use Trikoder\Model\Product;
use Trikoder\Model\Category;
use Trikoder\Helper\Country;
use Trikoder\Helper\Price;

class InvoiceItemTest extends \PHPUnit_Framework_TestCase
{
    public function testIfTotalPriceEqualsItemPriceMultipliedByAmountOfProducts()
    {
        $snickersPrice = 1.45;
        $amountOfProduct = 5;
        $product = new Product();
        $product->setId(1)
                ->setName('Snickers')
                ->setCategory(Category::fromString('sweets'))
                ->setCountry(Country::fromString('AL'));

        $price = new Price($snickersPrice);

        $item = new InvoiceItem($product, $amountOfProduct, $price);

        $this->assertEquals($item->getTotalPrice()->getAmount(), $snickersPrice * $amountOfProduct);
    }
}
