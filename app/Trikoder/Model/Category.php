<?php

namespace Trikoder\Model;

/**
 * Kategorija proizvoda
 */
class Category
{
    /** @var string Tip proizvoda */
    private $name;

    /** @var string[] */
    private static $supported = [
        'fruit',
        'vegetable',
        'sweets',
        'milk product',
        'newspaper',
        'soft drink',
    ];

    /**
     *
     * @param string $name Ime kategorije
     * @throws InvalidArgumentException U slučaju nepodržanog imena kategorije
     */
    private function __construct($name)
    {
        if (!in_array($name, self::$supported)) {
            throw new \InvalidArgumentException('Kategorija proizvoda '.$name.' nije podržana.');
        }
        $this->name = $name;
    }

    /**
     * Stvara instancu klase na temelju proslijeđenog stringa
     *
     * @param  string $name
     * @return self
     */
    public static function fromString($name)
    {
        return new self($name);
    }
}
