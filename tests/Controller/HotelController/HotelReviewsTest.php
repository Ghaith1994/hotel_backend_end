<?php

namespace App\Tests\Controller\HotelController;

use DateTime;
use  Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelReviewsTest extends WebTestCase
{
    public function testRequestWithoutFilter(): void
    {
        $client = static::createClient();

        $client->request('GET', '/hotel/1/hotel-reviews');

        $this->assertResponseIsSuccessful();
    }

    public function testRequestWithFilter(): void
    {
        $fromDate = new DateTime('now -2 year');
        $toDate = new DateTime('now');
        $url = sprintf('/hotel/%u/hotel-reviews?fromDate=%s&toDate=%s',1,$fromDate->format("Y-m-d"),$toDate->format("Y-m-d"));

        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }
}
