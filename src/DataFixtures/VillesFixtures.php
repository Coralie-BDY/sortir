<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
class VillesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($v = 0; $v <= 10; $v++)
        {
            $ville = new Ville();
            $ville->setVille($faker->city)
                ->setCodePostal($faker->numberBetween(10000, 99999));
            $manager->persist($ville);

            $this->addReference('ville_' . $v, $ville);

        }
        $manager->flush();
    }

}

