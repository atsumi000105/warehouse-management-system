<?php

namespace App\Tests;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AbstractWebTestCase extends WebTestCase
{
    /** @var ObjectManager|object */
    protected $objectManager;

    public function setUp(): void
    {
        parent::setUp();

        $this->objectManager = self::bootKernel()
            ->getContainer()
            ->get('doctrine')
            ->getManager();
    }
}
