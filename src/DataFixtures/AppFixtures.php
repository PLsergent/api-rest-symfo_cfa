<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       // category
       $category1 = new Category();
       $category1->setName('Cuisine')
                   ->setDescription("Tout pour l'homme en cuisine");
       $manager->persist($category1);
       $category2 = new Category();
       $category2->setName('Jardin')
                   ->setDescription("Bêche, pelle, scie à main");
       $manager->persist($category2);
       $category3 = new Category();
       $category3->setName('Pêche')
                   ->setDescription("Canne et hameçon");
       $manager->persist($category3);
      
       //$product
       $product1 = new Product();
       $product1->setName('Soupiere')
                ->setDescription("La bonne soupe")
                ->setPriceHT(50)
                ->setAvailable(1)
                ->setCategory($category1);
        $manager->persist($product1);
        $product2 = new Product();
        $product2->setName('Louche')
                 ->setDescription("C'est pas louche")
                 ->setPriceHT(20)
                 ->setAvailable(1)
                 ->setCategory($category1);
        $manager->persist($product2);
        $product3 = new Product();
        $product3->setName('Louche')
                 ->setDescription("C'est pas louche")
                 ->setPriceHT(12)
                 ->setAvailable(1)
                 ->setCategory($category1);
        $manager->persist($product3);
        $product4 = new Product();
        $product4->setName('Louche')
                 ->setDescription("C'est pas louche")
                 ->setPriceHT(7)
                 ->setAvailable(0)
                 ->setCategory($category2);
        $manager->persist($product4);
        $product5 = new Product();
        $product5->setName('Louche')
                 ->setDescription("C'est pas louche")
                 ->setPriceHT(16)
                 ->setAvailable(1)
                 ->setCategory($category3);
        $manager->persist($product5);       
        
        //$user
        $user1 = new User();
        $user1->setEmail('toto@toto.fr')
                 ->setRoles(['ROLE_USER'])
                 ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$d3Y3T3IuU0VRelhvS3hXQg$266cZRipeMCa5KZXxKRSCqrhnFNVZLfQ0V20fccx/D8');
        $manager->persist($user1); //pw:totototo
        $user2 = new User();
                $user2->setEmail('admin@admin.fr')
                 ->setRoles(['ROLE_ADMIN'])
                 ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$QUtyZUk4TlpXYUNrTEM4Qg$s0YLPyGATwrvoIs0HDm6XtNsA+3d9eA0gzHVl4HrYW8');
        $manager->persist($user2);  //pw:adminadmin
        $manager->flush();  
    }
}
