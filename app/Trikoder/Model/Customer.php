<?php

namespace Trikoder\Model;

/**
 * Kupac proizvoda
 *
 * Pretpostavka da su sva polja obavezna, te da nema potrebe za detaljnijom provjerom validnosti
 * korisnikovih podataka, pošto je u specifikaciji zadatka navedeno da u podaci obični string,
 * te nisam dobio dojam da su od presudne važnosti za zadatak
 */
class Customer
{
    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var string */
    private $street;

    /** @var string */
    private $city;

    /** @var string */
    private $zipCode;

    /** @var string */
    private $countryCode;

    /** @var string */
    private $mobilePhoneNumber;

    /** @var var string */
    private $email;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function setMobilePhoneNumber($mobilePhoneNumber)
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Formatira podatke o korisniku
     *
     * @return string
     */
    public function toString()
    {
        $customerInfo = $this->firstName . ' ' . $this->lastName . PHP_EOL . PHP_EOL;
        $customerInfo .= $this->street . PHP_EOL;
        $customerInfo .= $this->zipCode . ' ' . $this->city . PHP_EOL . PHP_EOL;
        $customerInfo .= 'Email: ' . $this->email . PHP_EOL;
        $customerInfo .= 'Phone: ' . $this->mobilePhoneNumber;

        return $customerInfo;
    }
}
