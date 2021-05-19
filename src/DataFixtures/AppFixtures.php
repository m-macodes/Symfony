<?php

namespace App\DataFixtures;

use App\Entity\Items;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++) {
            $item = new Items();
            $item
                ->setTitle('Item' . $i)
                ->setCategory('Category' . $i)
                ->setDescription('Description' . $i)
                ->setPrice('1000');
            $manager->persist($item);
        }

        //$product = new Product();
        //$manager->persist($product);

        $manager->flush();
    }
}
