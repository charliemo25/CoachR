<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $available = ['matin', 'après-midi', 'soir'];
        $roles = [['ROLE_USER'], ['ROLE_COACH']];
        $experiences = ['débutant', 'intermediaire', 'expert'];

        for ($i = 0; $i < 20; $i++) {
            $data = $faker->email();
            $user = new User();
            $user->setEmail($data)
                ->setPassword($data)
                ->setRoles($roles[rand(0,1)])
                ->setAvailability($available[rand(0,2)])
                ->setExperience($experiences[rand(0,2)]);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
