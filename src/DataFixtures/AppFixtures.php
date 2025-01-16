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
        $category1 = (new Category())
        ->setName('Technology')
        ->setDescription('All things technology');
    
    $category2 = (new Category())
        ->setName('Lifestyle')
        ->setDescription('Lifestyle articles and tips');
    
    $category3 = (new Category())
        ->setName('Programming')
        ->setDescription('Learn about programming languages, frameworks, and tools');
    
    $manager->persist($category1);
    $manager->persist($category2);
    $manager->persist($category3);
    
    // Sub-categories for Technology
    $subCategory1 = (new SubCategory())
        ->setName('Artificial Intelligence')
        ->setDescription('Everything about AI and Machine Learning')
        ->setCategory($category1);
    
    $subCategory2 = (new SubCategory())
        ->setName('Cloud Computing')
        ->setDescription('Explore cloud services and architecture')
        ->setCategory($category1);
    
    $subCategory3 = (new SubCategory())
        ->setName('Cybersecurity')
        ->setDescription('Best practices and innovations in cybersecurity')
        ->setCategory($category1);
    
    $manager->persist($subCategory1);
    $manager->persist($subCategory2);
    $manager->persist($subCategory3);
    
    // Sub-categories for Lifestyle
    $subCategory4 = (new SubCategory())
        ->setName('Health & Wellness')
        ->setDescription('Tips for a healthy lifestyle')
        ->setCategory($category2);
    
    $subCategory5 = (new SubCategory())
        ->setName('Travel')
        ->setDescription('Guides and tips for traveling')
        ->setCategory($category2);
    
    $subCategory6 = (new SubCategory())
        ->setName('Food & Nutrition')
        ->setDescription('Recipes and healthy eating tips')
        ->setCategory($category2);
    
    $manager->persist($subCategory4);
    $manager->persist($subCategory5);
    $manager->persist($subCategory6);
    
    // Sub-categories for Programming
    $subCategory7 = (new SubCategory())
        ->setName('Web Development')
        ->setDescription('Frontend and backend programming')
        ->setCategory($category3);
    
    $subCategory8 = (new SubCategory())
        ->setName('Mobile Development')
        ->setDescription('Building apps for iOS and Android')
        ->setCategory($category3);
    
    $subCategory9 = (new SubCategory())
        ->setName('Data Science')
        ->setDescription('Learn data analysis and machine learning')
        ->setCategory($category3);
    
    $manager->persist($subCategory7);
    $manager->persist($subCategory8);
    $manager->persist($subCategory9);
    

        // Creazione Tags
        $tags = [
            (new Tags())->setName('AI'),             // Tag 0
            (new Tags())->setName('Technology'),    // Tag 1
            (new Tags())->setName('Programming'),   // Tag 2
            (new Tags())->setName('Python'),        // Tag 3
            (new Tags())->setName('Web Development'), // Tag 4
            (new Tags())->setName('JavaScript'),    // Tag 5
            (new Tags())->setName('Health'),        // Tag 6
            (new Tags())->setName('Wellness'),      // Tag 7
            (new Tags())->setName('Meditation'),    // Tag 8
            (new Tags())->setName('Nutrition'),     // Tag 9
            (new Tags())->setName('HTML'),          // Tag 10
            (new Tags())->setName('CSS'),           // Tag 11
            (new Tags())->setName('PHP'),           // Tag 12
            (new Tags())->setName('Symfony'),       // Tag 13
            (new Tags())->setName('React.js'),      // Tag 14
            (new Tags())->setName('Backend'),       // Tag 15
            (new Tags())->setName('Frontend'),
            (new Tags())->setName('best')       // Tag 16
        ];
        

        foreach ($tags as $tag) {
            $manager->persist($tag);
        }

        // Creazione Utenti
        $user = (new User())
            ->setEmail('elie@gmail.com')
            ->setUsername('user123')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->passwordHasher->hashPassword(new User(), 'Elie2020@'));
        $manager->persist($user);

        $user2 = (new User())
            ->setEmail('abib@gmail.com')
            ->setUsername('abib_123')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordHasher->hashPassword(new User(), 'Abib2020@'));
        $manager->persist($user2);

        // Creazione Posts
        $posts = [
            // SubCategory 1: Programming
            (new Posts())
                ->setTitle('L’avenir de l’intelligence artificielle')
                ->setBody('L’intelligence artificielle est en train de révolutionner notre monde...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category1)
                ->setSubCategory($subCategory9)
                ->addTag($tags[0])
                ->addTag($tags[1]),
        
            (new Posts())
                ->setTitle('Les bases de la programmation en Python')
                ->setBody('Apprenez les bases de Python, un langage polyvalent et puissant...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category1)
                ->setSubCategory($subCategory8)
                ->addTag($tags[2])
                ->addTag($tags[3]),
        
            (new Posts())
                ->setTitle('Introduction au développement web avec JavaScript')
                ->setBody('JavaScript est essentiel pour créer des applications web interactives...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category1)
                ->setSubCategory($subCategory1)
                ->addTag($tags[4])
                ->addTag($tags[5]),
        
            // SubCategory 2: Health
            (new Posts())
                ->setTitle('Comment mener une vie plus saine')
                ->setBody('Vivre en meilleure santé commence par de petites habitudes...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category2)
                ->setSubCategory($subCategory2)
                ->addTag($tags[6])
                ->addTag($tags[7]),
        
            (new Posts())
                ->setTitle('Les bienfaits de la méditation quotidienne')
                ->setBody('La méditation peut réduire le stress et améliorer votre bien-être mental...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category2)
                ->setSubCategory($subCategory3)
                ->addTag($tags[8])
                ->addTag($tags[9]),
        
            (new Posts())
                ->setTitle('Adopter une alimentation équilibrée')
                ->setBody('Une alimentation équilibrée est essentielle pour maintenir une bonne santé...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category2)
                ->setSubCategory($subCategory4)
                ->addTag($tags[10])
                ->addTag($tags[11]),
        
            // SubCategory 3: Web Development
            (new Posts())
                ->setTitle('Maîtriser les bases du HTML')
                ->setBody('HTML est le langage fondamental pour construire des pages web...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category3)
                ->setSubCategory($subCategory5)
                ->addTag($tags[12])
                ->addTag($tags[13]),
        
            (new Posts())
                ->setTitle('Créer des sites dynamiques avec PHP')
                ->setBody('PHP reste un des langages de choix pour le développement backend...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category3)
                ->setSubCategory($subCategory6)
                ->addTag($tags[14])
                ->addTag($tags[15]),
        
            (new Posts())
                ->setTitle('Développement frontend avec React.js')
                ->setBody('React est une bibliothèque JavaScript puissante pour créer des interfaces utilisateur...')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setUser($user)
                ->setCategory($category3)
                ->setSubCategory($subCategory7)
                ->addTag($tags[16])
                ->addTag($tags[17]),
        ];
        

        foreach ($posts as $post) {
            $manager->persist($post);
        }

        // Creazione UserProfile
        $userProfile = (new UserProfile())
            ->setBio('I am a passionate web developer.')
            ->setUser($user);
        $manager->persist($userProfile);

        // Creazione Websites e connessione con UserProfile
        $websites = [
            (new Website())
                ->setName('Personal Blog')
                ->setUrl('https://user123-blog.com')
                ->setUserProfile($userProfile),
            (new Website())
                ->setName('LinkedIn Profile')
                ->setUrl('https://linkedin.com/in/user123')
                ->setUserProfile($userProfile),
        ];

        foreach ($websites as $website) {
            $manager->persist($website);
            $userProfile->addWebsite($website); // Connetti il Website al UserProfile
        }

        // Creazione UserStacks
        $stacks = [
            (new UserStack())->setName('PHP Developer'),
            (new UserStack())->setName('JavaScript Developer'),
            (new UserStack())->setName('Java Developer'),
            (new UserStack())->setName('C Developer'),
        ];

        foreach ($stacks as $stack) {
            $manager->persist($stack);
            $userProfile->setUserStack($stack); // Connetti lo Stack al UserProfile
        }

        $manager->flush();
    }
}
