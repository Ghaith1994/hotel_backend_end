<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        // create 100000 reviews
        $batchSize = 20;
        for ($i = 0; $i < 100000; $i++) {
            $hotel = $this->getReference(HotelFixtures::HOTEL_REFERENCE.mt_rand(1,10));

            $review = new Review();
            $review->setCreatedDate($this->faker->dateTimeBetween('-730 days', 'now'));
            $review->setScore($this->faker->numberBetween(0,100));
            $review->setComment($this->faker->realText(100));
            $review->setHotel($hotel);
            $manager->persist($review);

            if ($i % $batchSize === 0) { $manager->flush(); $manager->clear(); }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            HotelFixtures::class,
        ];
    }
}
