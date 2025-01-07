<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\SubCategory;
use App\Entity\Posts;
use App\Entity\Tags;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserStack;
use App\Entity\Website;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $category1 = new Category();
        $category1->setName('Technology')
                  ->setDescription('All things technology');
        
        $category2 = new Category();
        $category2->setName('Lifestyle')
                  ->setDescription('Lifestyle articles and tips');
        
        $manager->persist($category1);
        $manager->persist($category2);

        $subCategory1 = new SubCategory();
        $subCategory1->setName('Programming')
                     ->setDescription('All about programming')
                     ->setCategory($category1);

        $subCategory2 = new SubCategory();
        $subCategory2->setName('Health')
                     ->setDescription('Health and well-being tips')
                     ->setCategory($category2);

        $manager->persist($subCategory1);
        $manager->persist($subCategory2);

        $tag1 = new Tags();
        $tag1->setName('AI');
        $tag2 = new Tags();
        $tag2->setName('Technology');
        $tag3 = new Tags();
        $tag3->setName('PHP');
        $tag4 = new Tags();
        $tag4->setName('Symfony');
        $tag5 = new Tags();
        $tag5->setName('Wellness');
        $tag6 = new Tags();
        $tag6->setName('Fitness');
        $tag7 = new Tags();
        $tag7->setName('JavaScript');
        $tag8 = new Tags();
        $tag8->setName('HTML');

        $manager->persist($tag1);
        $manager->persist($tag2);
        $manager->persist($tag3);
        $manager->persist($tag4);
        $manager->persist($tag5);
        $manager->persist($tag6);
        $manager->persist($tag7);
        $manager->persist($tag8);

        $user = new User();
            $user->setEmail('elie@gmail.com')
             ->setUsername('user123') 
             ->setRoles(['ROLE_USER'])
             ->setPassword($this->passwordHasher->hashPassword($user, 'Elie2020@'));
             $manager->persist($user);

        $user2 = new User();
            $user2->setEmail('abib@gmail.com')
             ->setUsername('abib_123')
             ->setRoles(['ROLE_ADMIN'])
             ->setPassword($this->passwordHasher->hashPassword($user2, 'Abib2020@'));
             $manager->persist($user2);
        

             $post1 = new Posts();
             $post1->setTitle('L’avenir de l’intelligence artificielle')
                 ->setBody('L’intelligence artificielle est en train de révolutionner notre monde, de la santé à l’éducation en passant par les transports. En adoptant des technologies basées sur l’IA, nous pouvons non seulement automatiser des tâches répétitives, mais également résoudre des problèmes complexes, comme le diagnostic médical ou l’optimisation des énergies renouvelables.')
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setUpdatedAt(new \DateTimeImmutable())
                 ->setUser($user)
                 ->setCategory($category1);
             $post1->addTag($tag1);
             $post1->addTag($tag2);
             
             $post2 = new Posts();
             $post2->setTitle('Comment mener une vie plus saine')
                 ->setBody('Vivre en meilleure santé commence par de petites habitudes. Buvez beaucoup d’eau, mangez des aliments riches en nutriments, et accordez-vous au moins 30 minutes d’exercice chaque jour. Adoptez la méditation ou la lecture pour apaiser votre esprit et dormez suffisamment pour une vie équilibrée.')
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setUpdatedAt(new \DateTimeImmutable())
                 ->setUser($user)
                 ->setCategory($category2);
             $post2->addTag($tag3);
             $post2->addTag($tag4);
             
             $post3 = new Posts();
             $post3->setTitle('Comprendre la puissance de JavaScript')
                 ->setBody('JavaScript est au cœur du développement web moderne. Il permet de rendre les sites interactifs, de gérer des applications complexes et d’offrir une expérience utilisateur fluide. Avec des frameworks comme React ou Vue.js, JavaScript continue de transformer la manière dont nous construisons le web.')
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setUpdatedAt(new \DateTimeImmutable())
                 ->setUser($user)
                 ->setCategory($category1);
             $post3->addTag($tag7);
             $post3->addTag($tag2);
             
             $post4 = new Posts();
             $post4->setTitle('Maîtriser le HTML pour le développement web')
                 ->setBody('HTML est la base de tout site web. En comprenant ses principes fondamentaux, comme les balises, les attributs et les formulaires, vous pouvez créer des pages structurées et accessibles. Ajoutez du style avec CSS et du dynamisme avec JavaScript pour un site complet.')
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setUpdatedAt(new \DateTimeImmutable())
                 ->setUser($user)
                 ->setCategory($category1);
             $post4->addTag($tag8);
             $post4->addTag($tag2);
             
             $post5 = new Posts();
             $post5->setTitle('L’importance du bien-être au quotidien')
                 ->setBody('Le bien-être est une combinaison d’un esprit sain dans un corps sain. Faites attention à votre alimentation, bougez régulièrement et entourez-vous de personnes positives. Prenez aussi le temps de vous recentrer sur vos passions et vos objectifs personnels.')
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setUpdatedAt(new \DateTimeImmutable())
                 ->setUser($user)
                 ->setCategory($category2);
             $post5->addTag($tag5);
             $post5->addTag($tag6);
             
             $post6 = new Posts();
             $post6->setTitle('Comment rester en forme à la maison')
                 ->setBody('Faire de l’exercice à domicile est plus facile que vous ne le pensez. Utilisez votre espace pour des exercices simples comme le yoga, les pompes, ou des étirements. Ajoutez des vidéos de fitness ou des applications pour une motivation supplémentaire.')
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setUpdatedAt(new \DateTimeImmutable())
                 ->setUser($user)
                 ->setCategory($category2);
             $post6->addTag($tag6);
             $post6->addTag($tag5);
             
             $post7 = new Posts();
             $post7->setTitle('Les meilleures pratiques PHP pour les développeurs')
                 ->setBody('PHP reste un langage de choix pour le développement backend. En suivant des pratiques comme l’utilisation de frameworks modernes, l’écriture de tests automatisés et la sécurisation des données, vous pouvez créer des applications robustes et maintenables.')
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setUpdatedAt(new \DateTimeImmutable())
                 ->setUser($user)
                 ->setCategory($category1);
             $post7->addTag($tag3);
             $post7->addTag($tag4);
             

        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);
        $manager->persist($post5);
        $manager->persist($post6);
        $manager->persist($post7);

        $website1 = new Website();
        $website1->setName('My Website')
                 ->setUrl('https://mywebsite.com');

        $website2 = new Website();
        $website2->setName('Google')
                 ->setUrl('https://google.com');

        $manager->persist($website1);
        $manager->persist($website2);

        $userProfile = new UserProfile();
        $userProfile->setBio('I am a passionate web developer.')
                    ->setUser($user)
                    ->setWebsite($website1);

        $manager->persist($userProfile);

        $userStack = new UserStack();
        $userStack->setName('PHP Developer');
        $manager->persist($userStack);

        $userProfile->setUserStack($userStack);

        $manager->flush();
    }
}
