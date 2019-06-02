<?php

namespace App\DataFixtures;

use App\Entity\Bug;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class BugFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('en_EN');

        for($i = 1; $i <= 6; $i++){
            $user = new User();
            $user->setUsername($faker->name)
                ->setPassword($faker->word);
            $manager->persist($user);

            for($j = 1; $j <= 10; $j++){
                $bug = new Bug();
                $bug->setTitle($faker->sentence())
                    ->setDescription($faker->paragraph())
                    ->setState("open")
                    ->setSeverity("low")
                    ->addContributor($user);
                $manager->persist($bug);
            }
        }
        $manager->flush();
    }
}


