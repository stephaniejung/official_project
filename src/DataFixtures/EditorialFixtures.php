<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Heading;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EditorialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i <= 4; $i++){
            $heading = new Heading();
            $heading ->setTitle("Rubrique $i")
                ->setSubtitle("Sous-titre $i")
                ->setDescription("Description de la rubrique $i")
                ->setPosition($i)
                ->setActive(0);

            for($j = 1; $j <= rand(2,5); $j++){
                $article = new Article();
                $article ->setTitle("Article $i-$j")
                    ->setContent("<p>Contenu de l'article num $i-$j Some quick example text to build on the card title and make up the bulk of the card's content.</p>")
                    ->setImage("http://placehold.it/640x360")
                    ->setCreatedAt(new \DateTime())
                    ->setPosition($j)
                    ->setHeading($heading)
                    ->setValidated(0);

                $manager->persist($article);
            }

            $manager->persist($heading);
        }

        $manager->flush();
    }
}
