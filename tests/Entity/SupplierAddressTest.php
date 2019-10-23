<?php


namespace App\Tests\Entity;

use App\Entity\SupplierAddress;
use App\Tests\AbstractWebTestCase;

class SupplierAddressTest extends AbstractWebTestCase
{

    public function testIsValidReturnsTrueWhenNotEmpty()
    {
        $address = new SupplierAddress();
        $address->setStreet1($this->faker->streetAddress);
        $address->setCity($this->faker->city);
        $address->setState($this->faker->stateAbbr);
        $address->setPostalCode($this->faker->postcode);
        $this->assertTrue($address->isValid());
    }


    /**
     * @testWith    [null, "Anywhere", "Texas", "12345"]
     *              ["123 Main", null, "Texas", "12345"]
     *              ["123 Main", "Anywhere", null, "12345"]
     *              ["123 Main", "Anywhere", "Texas", null]
     */
    public function testIsValidReturnsFalseWhenAnyEmpty(?string $addr1,
                                                        ?string $city,
                                                        ?string $stateAbr,
                                                        ?string $postCode)
    {
        $address = new SupplierAddress();
        $address->setStreet1($addr1);
        $address->setCity($city);
        $address->setState($stateAbr);
        $address->setPostalCode($postCode);
        $this->assertFalse($address->isValid());
    }
}
