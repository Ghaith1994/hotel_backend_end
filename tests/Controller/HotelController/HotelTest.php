<?php

namespace App\Tests\Controller\HotelController;

use DateTime;
use  Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelTest extends WebTestCase
{
    public function testRequest(): void
    {
        $client = static::createClient();

        $client->request('GET', '/hotel');

        $this->assertResponseIsSuccessful();
    }
}
