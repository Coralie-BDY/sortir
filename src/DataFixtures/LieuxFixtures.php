<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class LieuxFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($l = 0; $l <= 5; $l ++)
        {
            $ville = $this->getReference('ville_'. rand(1, 9));
            $lieu = new Lieu();
            $lieu->setNom($faker->word)
                ->setAdresse($faker->address)
                ->setVille($ville)
                ->setLatitude($faker->latitude)
                ->setLongitude($faker->longitude);
            $manager->persist($lieu);

           $this->addReference('lieu_'. $l,$lieu);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [VillesFixtures::class];
    }
}
