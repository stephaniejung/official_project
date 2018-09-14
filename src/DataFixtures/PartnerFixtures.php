<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Partner;


class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i = 1; $i <= 26; $i++){
            $partner = new Partner();
            $partner ->setName("Partenaire num $i")
                ->setImage("http://placehold.it/130x130")
                ->setLink("https://www.google.fr")
                ->setCreatedAt(new \DateTime())
                ->setValidated(0);

            $manager->persist($partner);
        }

        $manager->flush();
    }
}
