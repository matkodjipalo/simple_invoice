<?php

namespace Trikoder\Repository;

use Trikoder\Model\Customer;
use PDO;

/**
 * Repozirorij za korisnika fakture
 */
class CustomerRepository extends BaseRepository
{
    /**
     * Vraća korisnika na temelju ID-a iz baze
     *
     * @param  int $id
     * @return Customer
     */
    public function findOneById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM customer WHERE id = :id');
        $statement->execute(array('id' => $id));
        $customerArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$customerArray) {
            return null;
        }

        return $this->createCustomerFromArray($customerArray);
    }

    /**
     * Pomoćna factory metoda koja stvara korisnika na temelju podataka iz baze
     *
     * @param  array $customerArray
     * @return Customer
     */
    private function createCustomerFromArray($customerArray)
    {
        $customer = new Customer();
        $customer->setId($customerArray['id'])
                ->setFirstName($customerArray['first_name'])
                ->setLastName($customerArray['last_name'])
                ->setStreet($customerArray['street'])
                ->setZipCode($customerArray['zip_code'])
                ->setCity($customerArray['city'])
                ->setCountryCode($customerArray['country_code'])
                ->setMobilePhoneNumber($customerArray['mobile_phone_nr'])
                ->setEmail($customerArray['email']);

        return $customer;

    }
}
