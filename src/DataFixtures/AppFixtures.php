<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    protected $slugger;
    protected $encoder;

    public function __construct(SluggerInterface $slugger, UserPasswordEncoderInterface $encoder)
    {
        $this->slugger = $slugger;
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('FR-fr');

        $admin = new User();
        $hash = $this->encoder->encodePassword($admin, "password");
        $admin->setEmail("admin@gmail.com")
            ->setFullName("admin")
            ->setPassword($hash)
            ->setVerifPassword($hash)
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $aUsers = [];
        for ($u = 0; $u < 5; $u++) {
            $user = new User();
            $hash = $this->encoder->encodePassword($user, "password");
            $user->setEmail("user$u@gmail.com")
                ->setFullName($faker->name())
                ->setPassword($hash)
                ->setVerifPassword($hash);

            $manager->persist($user);
            $aUsers[] = $user;
        }

        $categoryName = ['Grabs', 'Rotations', 'Flips', 'Rotations désaxées', 'Slides', 'One foot'];
        $tricksName = ['Mute', 'Indy', '360', '720', 'Backflip', 'Misty', 'Tail slide', 'Method air', 'Backside air'];


        $aCategory = [];
        foreach ($categoryName as $name) {

            $category = new Category();
            $category->setName($name)
                ->setSlug(strtolower($this->slugger->slug($category->getName())));

            $manager->persist($category);
            $aCategory[] = $category;
        }

        foreach ($aCategory as $categorie) {
            for ($i = 0; $i <= mt_rand(5, 15); $i++) {

                $trick = new Trick();
                $trick->setName($faker->randomElement($tricksName))
                    ->setDescription($faker->paragraph(5))
                    ->setSlug(strtolower($this->slugger->slug($trick->getName())))
                    ->setCreatAt($faker->dateTimeBetween('-6 months'))
                    ->setPicture('img/tricks/img' . $faker->numberBetween(1, 39) . '.jpg')
                    ->setUser($faker->randomElement($aUsers))
                    ->setCategory($categorie);

                $manager->persist($trick);

            }
        }


        $manager->flush();
    }
}
