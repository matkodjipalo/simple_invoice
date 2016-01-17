<?php

namespace Trikoder\Helper;

/**
 * Cijena proizvoda
 */
class Price
{
    /** @var float */
    private $amount;

    /** @var string Oznaka valute */
    private $currency;

    /**
     *
     * @param float $amount Novčani iznos
     * @param string $currency Valuta (za potrebe zadatka pretpostavka da je valuta uvijek euro)
     */
    public function __construct($amount, $currency = "EUR")
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount()
    {
        return (float)$this->amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function add(self $price)
    {
        $this->amount += $price->amount;
        return $this;
    }

    public function multiplyWith($nrOfMultiplications)
    {
        $this->amount *= $nrOfMultiplications;
        return $this;
    }
}
