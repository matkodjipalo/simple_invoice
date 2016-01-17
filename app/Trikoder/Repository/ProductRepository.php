<?php

namespace Trikoder\Repository;

use Trikoder\Model\Product;
use Trikoder\Model\Category;
use Trikoder\Helper\Country;
use PDO;

/**
 * Repozitorij za proizvod sa stavke fakture
 */
class ProductRepository extends BaseRepository
{
    /**
     * Vraća proizvod na temelju ID-a iz baze
     *
     * @param  int $id
     * @return Product|null
     */
    public function findOneById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM product WHERE id = :id');
        $statement->execute(array('id' => $id));
        $productArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$productArray) {
            return null;
        }

        return $this->createProductFromArray($productArray);
    }

    /**
     * Pomoćna factory metoda koja stvara proizvod na temelju podataka iz baze
     *
     * @param  array $invoiceArray
     * @return Invoice
     */
    private function createProductFromArray($productArray)
    {
        $product = new Product();
        $product->setId($productArray['id'])
                ->setName($productArray['name'])
                ->setCategory(Category::fromString($productArray['category']))
                ->setCountry(Country::fromString($productArray['country_of_origin_code']));

        return $product;

    }
}
