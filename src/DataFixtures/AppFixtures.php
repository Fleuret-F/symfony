<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $pwd) 
    {
        $this->hasher = $pwd;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=3; $i <10 ; $i++) { 
            $user = new User();
            $user->setPrenom("Bart");
            $user->setNom("Simpson");
            $user->setEmail("test$i@test.fr");
    
            $password = $this->hasher->hashPassword($user, "coucou");
            $user->setPassword($password);
    
            $manager->persist($user); // persist permet de récupérer les informations saisies par l'utilisateur 
        }
        $manager->flush();
    }
}
