<?php

namespace App\Tests\Controller;

use App\DataFixtures\ClientAttributeFixtures;
use App\DataFixtures\ClientFixtures;
use App\DataFixtures\GroupFixtures;
use App\DataFixtures\PartnerFixtures;
use App\DataFixtures\PartnerProfileAttributeFixtures;
use App\DataFixtures\PartnerProfileFixtures;
use App\DataFixtures\UserFixtures;
use App\Entity\Client;
use App\Tests\AbstractWebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

/**
 * @group Integration
 * @coversNothing
 */
class ClientControllerTest extends AbstractWebTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures([
            PartnerFixtures::class,
            PartnerProfileAttributeFixtures::class,
            PartnerProfileFixtures::class,
            ClientAttributeFixtures::class,
            ClientFixtures::class,
            GroupFixtures::class,
            UserFixtures::class,
        ]);
    }

    public function testShow()
    {
        $this->loginAsAdmin();

        $clientAccount = $this->getClientAccount();
        $uuid = $clientAccount->getUuid()->toString();
        $this->client->request('GET', "/api/clients/{$uuid}");

        $response = $this->getDecodedResponse();

        $this->assertEquals($uuid, $response['id']);
    }

    public function testCannotShowBadUuid()
    {
        $this->loginAsAdmin();

        $badUuid = '1234';

        $this->client->request('GET', "/api/clients/{$badUuid}");

        $response = $this->getDecodedResponse();
        $this->assertResponseStatusCodeSame('404');
    }

    public function testUpdate()
    {
        $this->loginAsAdmin();

        $clientAccount = $this->getClientAccount();
        $uuid = $clientAccount->getUuid()->toString();
        $name = $clientAccount->getName();
        $firstName = $name['getFirstname'];
        $lastName = $name['getLastname'];

        $newLastName = uniqid();

        $params['name'] = ['firstName' => $firstName, 'lastName' => $newLastName];

        $this->client->request('PATCH', "/api/clients/{$uuid}", $params);

        $response = $this->getDecodedResponse();

        $this->assertEquals($uuid, $response['id']);
        $this->assertEquals($firstName, $response['firstName']);
        $this->assertEquals($newLastName, $response['lastName']);
    }

    protected function getClientAccount(): Client
    {
        $clients = $this->objectManager->getRepository(Client::class)->findAll();

        return $clients[0];
    }
}
