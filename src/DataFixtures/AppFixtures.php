<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        $categoryName = ['Grabs', 'Rotations', 'Flips', 'Rotations désaxées', 'Slides', 'One foot', 'Old school'];
        $tricksName = ['Mute', 'Indy', '360', '720', 'Backflip', 'Misty', 'Tail slide', 'Method air', 'Backside air'];

        $faker = \Faker\Factory::create('FR-fr');
//        $aCategory = [];
        foreach ($categoryName as $name) {

            $category = new Category();
            $category->setName($name)
                ->setSlug(strtolower($this->slugger->slug($category->getName())));

            $manager->persist($category);
//            $aCategory[] = $category;

            for ($i = 0; $i <= mt_rand(5, 15); $i++) {

                $trick = new Trick();
                $trick->setName($faker->randomElement($tricksName))
                    ->setDescription($faker->sentence())
                    ->setSlug(strtolower($this->slugger->slug($trick->getName())))
                    ->setCreatAt($faker->dateTimeBetween('-6 months'))
                    ->setPicture('img/tricks/img' . $faker->numberBetween(1, 39) . '.jpg')
                    ->setCategory($category);

                $manager->persist($trick);

            }


        }


        $manager->flush();
    }
}
