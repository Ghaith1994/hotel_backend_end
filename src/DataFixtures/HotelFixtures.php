<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HotelFixtures extends Fixture
{
    public const HOTEL_REFERENCE = 'hotel';

    public function load(ObjectManager $manager): void
    {
        // create 10 hotels
        for ($i = 1; $i <= 10; $i++) {
            $hotel = new Hotel();
            $hotel->setName('hotel '.$i);
            $manager->persist($hotel);

            $this->addReference(self::HOTEL_REFERENCE.$i, $hotel);
        }

        $manager->flush();
    }
}
