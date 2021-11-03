<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0 ; $i < 10 ; $i++) {
        	$post = new Post();
        	$post->setTitle($faker->sentence( 6, true))
        		 ->setContent($faker->realText(200,4))
        		 ->setCreateAt(new \DateTime);
        	$manager->persist($post);	
        	for ($j= 0; $j <rand(2,4) ; $j++) { 
        			$comment = new Comment();
        			$comment->setContent($faker->sentence(6,true))
        					->setCreateAt(new \DateTime)
        					->setPost($post);
        		$manager->persist($comment);
        	}
        }

        $manager->flush();
    }
}
