<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $etats = [
        1=>['name' => 'Créée'],
        2=>['name' => 'Ouverte'],
        3=>['name' => 'En cours'],
        4=>['name' => 'Passée'],
        5=>['name' => 'Annulée']
    ];

        foreach ($etats as $key => $value)
        {
            $etat = new Etat();
            $etat->setLibelle($value['name']);
            $manager->persist($etat);

            $this->addReference('etat_'. $key, $etat );
        }

        $manager->flush();
    }
}
