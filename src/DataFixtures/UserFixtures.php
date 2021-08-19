<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
     private $passwordHasher;

     public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
       $this->passwordHasher = $passwordHasher;
   }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        // $product = new Product();
        // $manager->persist($product);
        $user->setEmail('admin@urbanicfarm.com');
        $user->setRoles(['ROLE-ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword(
                        $user,
                         '12345678'
                     ));
        $manager->persist($user);
        $manager->flush();
    }
}