<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EntrepriseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create();
        // $product = new Product();
        // $manager->persist($product);
        for($i=0;$i<10;$i++)
        {
            $entreprise =new Entreprise();
            $entreprise->setDesignation($faker->domainName);
            $manager->persist($entreprise);
        }
        $manager->flush();
    }
}
