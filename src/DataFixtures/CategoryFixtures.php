<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class
CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // instanciation de faker
        $faker = Factory::create('fr_FR');

        // Création 3catégorie
        for($i=0;$i<3;$i++){
            $category = new Category();
            $category->setName($faker->realText(15));

            $manager->persist($category);

         // Définir une référence surl'entité, pour le récupérer dans d'autres fixtures (etiquette)
            $reference ='Category_'.$i;
            $this->addReference($reference,$category);
        }

        $manager->flush();
    }
}
