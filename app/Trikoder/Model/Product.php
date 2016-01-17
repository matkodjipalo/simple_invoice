<?php

namespace Trikoder\Model;

use Trikoder\Helper\Country;

/**
 * Proizvod
 */
class Product
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Category */
    private $category;

    /** @var Country Kupujmo hrvatsko! */
    private $country;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }
}
