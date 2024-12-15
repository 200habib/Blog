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
        // Creazione delle categorie
        $category1 = new Category();
        $category1->setName('Technology')
                  ->setDescription('All things technology');
        
        $category2 = new Category();
        $category2->setName('Lifestyle')
                  ->setDescription('Lifestyle articles and tips');
        
        $manager->persist($category1);
        $manager->persist($category2);

        // Creazione delle sottocategorie
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

        // Creazione dei tag
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

        // Creazione degli utenti
        $user = new User();
        $user->setEmail('user@example.com')
             ->setUsername('user123') // Aggiungi il nome utente
             ->setRoles(['ROLE_USER'])
             ->setPassword($this->passwordHasher->hashPassword($user, 'password123'));

        $manager->persist($user);

        // Creazione dei post
        $post1 = new Posts();
        $post1->setTitle('The Future of AI')
              ->setBody('Artificial intelligence will shape the future...')
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable())
              ->setUser($user)
              ->setCategory($category1);
        $post1->addTag($tag1);
        $post1->addTag($tag2);

        $post2 = new Posts();
        $post2->setTitle('Living a Healthier Life')
              ->setBody('Simple tips for improving your well-being...')
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable())
              ->setUser($user)
              ->setCategory($category2);
        $post2->addTag($tag3);
        $post2->addTag($tag4);

        // Nuovi post
        $post3 = new Posts();
        $post3->setTitle('Understanding the Power of JavaScript')
              ->setBody('JavaScript continues to grow as a powerful tool for web development...')
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable())
              ->setUser($user)
              ->setCategory($category1);
        $post3->addTag($tag7);
        $post3->addTag($tag2);

        $post4 = new Posts();
        $post4->setTitle('Mastering HTML for Web Development')
              ->setBody('HTML forms the backbone of web development. Here’s how to master it...')
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable())
              ->setUser($user)
              ->setCategory($category1);
        $post4->addTag($tag8);
        $post4->addTag($tag2);

        $post5 = new Posts();
        $post5->setTitle('The Importance of Wellness in Everyday Life')
              ->setBody('Taking care of your mind and body is essential for success...')
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable())
              ->setUser($user)
              ->setCategory($category2);
        $post5->addTag($tag5);
        $post5->addTag($tag6);

        $post6 = new Posts();
        $post6->setTitle('How to Get Fit at Home')
              ->setBody('Fitness doesn’t need a gym. Here’s how you can get fit at home...')
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable())
              ->setUser($user)
              ->setCategory($category2);
        $post6->addTag($tag6);
        $post6->addTag($tag5);

        $post7 = new Posts();
        $post7->setTitle('PHP Best Practices for Developers')
              ->setBody('Improving your PHP code can enhance performance and maintainability...')
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable())
              ->setUser($user)
              ->setCategory($category1);
        $post7->addTag($tag3);
        $post7->addTag($tag4);

        // Persisti i nuovi post
        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);
        $manager->persist($post5);
        $manager->persist($post6);
        $manager->persist($post7);

        // Creazione dei siti web
        $website1 = new Website();
        $website1->setName('My Website')
                 ->setUrl('https://mywebsite.com');

        $website2 = new Website();
        $website2->setName('Google')
                 ->setUrl('https://google.com');

        $manager->persist($website1);
        $manager->persist($website2);

        // Creazione del profilo utente
        $userProfile = new UserProfile();
        $userProfile->setBio('I am a passionate web developer.')
                    ->setUser($user)
                    ->setWebsite($website1);

        $manager->persist($userProfile);

        // Creazione dello stack dell’utente
        $userStack = new UserStack();
        $userStack->setName('PHP Developer');
        $manager->persist($userStack);

        // Associa lo stack dell’utente al profilo
        $userProfile->setUserStack($userStack);

        // Salvataggio nel database
        $manager->flush();
    }
}
