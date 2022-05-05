<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\PFE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PFEFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create();
        // $product = new Product();
        // $manager->persist($product);

        for($i=0;$i<10;$i++)
        {
            $pfe =new PFE();
            $entreprise=new Entreprise();
            $entreprise->setDesignation($faker->company);
            $pfe->setTitle($faker->name);
            $pfe->setStudent($faker->name);
            $pfe->setEntreprise($entreprise);
            $manager->persist($entreprise);
            $manager->persist($pfe);
        }
        $manager->flush();
    }
}
