<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SortiesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for($sortie = 1; $sortie < 15; $sortie ++)
        {
            $date = $faker->dateTime;
            $ca = $this->getReference(('campus_'. $faker->numberBetween(1, 4)));
            $user = $this->getReference(('user_'. $faker->numberBetween(1, 5)));
            $etat = $this->getReference(('etat_'. $faker->numberBetween(1, 5)));
            $lieu = $this->getReference(('lieu_'. $faker->numberBetween(1, 5)));
            $s = new Sortie();
            $s->setCampus($ca)
                ->setNom($faker->word)
                ->setDescription($faker->text)
                ->setDate($date)
                ->setDuree($faker->randomDigit)
                ->setClotureinscription($faker->dateTimeBetween($s->getDate(), 'now'))
                ->setEtatsSortie($etat)
                ->setOrganisateur($user)
                ->setMaxinscrits($faker->numberBetween(5,10))
                ->setLieu($lieu);

            $manager->persist($s);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CampusFixtures::class,
            EtatFixtures::class,
            UsersFixtures::class,
            LieuxFixtures::class
        ];
    }
}
