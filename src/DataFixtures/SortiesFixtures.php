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

        //nom des sorties
        $name = [
            'Musée',
            'Balade',
            'Exposition',
            'Concert',
            'Soirée',
            'Théâtre',
            'Débat',
            'Cinéma',
            'Cuisine',
            'Sport',
            'Jeux de société'];

        //sorties  passées
        for ($s = 0; $s <= 6; $s++) {
            $sortiePassee = new Sortie();
            $sortiePassee->setCampus($this->getReference(('campus_'. rand(1, 4))))
                ->setNom($name[random_int(0, count($name) - 1)])
                ->setDescription($sortiePassee->getNom())
                ->setDate($faker->dateTimeThisYear($max = 'now'))
                ->setDuree(random_int(20, 120))
                ->setClotureinscription($faker->dateTimeBetween($sortiePassee->getDate(), 'now'))
                ->setEtatsSortie($this->getReference(('etat_' . 5)))
                ->setOrganisateur($this->getReference('user_'. random_int(1, 5)))
                ->setMaxinscrits(random_int(5, 20))
                ->setLieu($this->getReference('lieu_'. random_int(1, 5)));

            for ($count = 0; $count <= 6; $count++) {
                $sortiePassee->addUser($this->getReference('user_'. random_int(1, 5)));
            }

            $manager->persist($sortiePassee);
        }

        //Sorties en cours, annulée et ouverte
        for ($s1 = 0; $s1 <= 15; $s1++) {
            $sortie = new Sortie();
            $sortie->setCampus($this->getReference(('campus_' . rand(1, 4))))
                ->setNom($name[random_int(0, count($name) - 1)])
                ->setDescription($sortie->getNom())
                ->setDate($faker->dateTimeInInterval('now', '+' . random_int(7, 25) . 'days'))
                ->setDuree(random_int(20, 120))
                ->setClotureinscription($faker->dateTimeInInterval($sortie->getDate(), $interval = '- ' . random_int(2, 10). ' days'))
                ->setEtatsSortie($this->getReference(('etat_'. random_int(2, 4))))
                ->setOrganisateur($this->getReference('user_'. random_int(1, 5)))
                ->setMaxinscrits(random_int(5, 20))
                ->setLieu($this->getReference('lieu_'. random_int(1, 5)));
            for ($count1 = 0; $count1 <= 6; $count1++) {
                $sortie->addUser($this->getReference('user_'. random_int(1, 5)));
            }
            $manager->persist($sortie);
        }

        //sortie crée
        for ($s2 = 0; $s2 <= 5; $s2++) {
            $sortieCree = new Sortie();
            $sortieCree->setCampus($this->getReference(('campus_'. rand(1, 4))))
                ->setNom($name[random_int(0, count($name) - 1)])
                ->setDescription($sortieCree->getNom())
                ->setDate($faker->dateTimeInInterval('now', '+' . random_int(7, 25) . 'days'))
                ->setDuree(random_int(20, 120))
                ->setClotureinscription($faker->dateTimeInInterval($sortieCree->getDate(), $interval = '- ' . random_int(2, 10) . ' days'))
                ->setEtatsSortie($this->getReference(('etat_' . 1)))
                ->setOrganisateur($this->getReference('user_'. random_int(1, 5)))
                ->setMaxinscrits(random_int(5, 20))
                ->setLieu($this->getReference('lieu_'. random_int(1, 5)));

            $manager->persist($sortieCree);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            CampusFixtures::class,
            EtatFixtures::class,
            LieuxFixtures::class
        ];
    }
}
