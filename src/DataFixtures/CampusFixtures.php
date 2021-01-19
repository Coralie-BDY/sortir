<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $campus = [
            1=>['name' => 'Campus Quimper'],
            2=>['name' => 'Campus Nantes'],
            3=>['name' => 'Campus Rennes'],
            4=>['name' => 'Campus Niort']
        ];

        foreach ($campus as $key => $value)
        {
            $ca = new Campus();
            $ca->setCampus($value['name']);
            $manager->persist($ca);

            $this->addReference('campus_'. $key, $ca );
        }

        $manager->flush();
    }
}
