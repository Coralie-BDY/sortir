<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for($users =1; $users <= 5; $users ++)
        {
            $ca = $this->getReference(('campus_' . $faker->numberBetween(1, 4)));
            $user = new User();

            if($users === 1)
            {
                $user->setRoles(['ROLE_ADMIN'])
                    ->setAdmin(true)
                    ->setActif(true)
                    ->setPseudo('Neko')
                    ->setEmail('hello@kitty.fr');


            } else {
                $user->setRoles(['ROLE_USER'])
                    ->setAdmin(false)
                    ->setActif(true)
                    ->setPseudo($faker->userName)
                    ->setEmail($faker->email);
            }
            $user->setNom($faker->name)
                ->setPrenom($faker->firstName)
                ->setCampus($ca);
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user, 'hellokitty'));
            $manager->persist($user);

            $this->addReference('user_'. $users,$user );
        }

        $manager->flush();
    }
}
