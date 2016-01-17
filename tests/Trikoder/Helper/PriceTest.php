<?php

namespace tests\Trikoder\Model;

use Trikoder\Helper\Price;

class PriceTest extends \PHPUnit_Framework_TestCase
{
    public function testPriceHasAnExpectedAmount()
    {
        $expectedAmount = 33.45;
        $price = new Price(33.45);
        $this->assertEquals($expectedAmount, $price->getAmount());
    }

    public function testIfPriceMultiplicationWorks()
    {
        $baseAmount = 11.345;
        $multiplicator = 4;
        $expectedAmount = $baseAmount * $multiplicator;
        $price = new Price($baseAmount);
        $price->multiplyWith($multiplicator);

        $this->assertEquals($price->getAmount(), $expectedAmount);
    }

    public function testIfPriceAdditionWorks()
    {
        $price1 = 33.11;
        $price2 = 31.55;

        $priceObj1 = new Price($price1);
        $priceObj2 = new Price($price2);

        $this->assertEquals($priceObj1->add($priceObj2)->getAmount(), $price1 + $price2);
    }
}
