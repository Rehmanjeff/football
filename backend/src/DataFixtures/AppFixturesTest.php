<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Country;

class AppFixturesTest extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countries = [
            ['Country one', 'https://www.scorebar.com/images/flags/al.webp?w=28&h=21'],
            ['Country two', 'https://www.scorebar.com/images/flags/dz.webp?w=28&h=21'],
            ['Country three', 'https://www.scorebar.com/images/flags/ad.webp?w=28&h=21'],
        ];

        foreach ($countries as [$name, $flag]) {

            $country = new Country();
            $country->setName($name);
            $country->setFlagFile($flag);
            $manager->persist($country);
        }

        $manager->flush();
    }
}
