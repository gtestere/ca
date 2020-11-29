<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
		protected $faker;

		public function __construct() {
			$this->faker = Factory::create();
		}

	public function load(ObjectManager $manager)
    {
	    for ($i = 0; $i < 10; $i++) {
		    $hotel = new Hotel();
		    $hotel->setName($this->faker->text(15));
		    $this->addReference('hotel_' . $i, $hotel);
		    $manager->persist($hotel);
	    }


	    for ($i = 0; $i < 10000; $i++) {
		    $review = new Review();
		    $hotel = $this->getReference('hotel_' . $this->faker->numberBetween(1,9));
		    $review->setHotel($hotel);
		    $review->setScore($this->faker->numberBetween(1,100));
		    $review->setComment($this->faker->text(200));
		    $review->setCreateDate($this->faker->dateTimeBetween('-2 years'));
		    $manager->persist($review);
	    }

	    $manager->flush();
    }
}
