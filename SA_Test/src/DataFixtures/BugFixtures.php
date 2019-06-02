<?php

namespace App\DataFixtures;

use App\Entity\Bug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BugFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $bug = new Bug();
            $bug->setTitle("Titre de l'article $i")
                ->setDescription("Description $i")
                ->setState("open")
                ->setSeverity("low");
            $manager->persist($bug);
        }
        $manager->flush();
    }
}
