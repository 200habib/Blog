<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use App\Repository\CategoryRepository;
use App\Repository\TagsRepository;

use App\Entity\SubCategory;
use App\Repository\SubCategoryRepository;
use App\Entity\Website;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/posts')]
final class PostFilterByTagsController extends AbstractController
{


    #[Route('/category/{categoryId}', name: 'app_posts_by_category', methods: ['GET'])]
    public function filterByCategory(int $categoryId, PostsRepository $postRepository, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager, SubCategoryRepository $SubCategoryRepository): Response
    {
        
        $posts = $postRepository->findBy(['Category' => $categoryId]);

        // $dql = 'SELECT p FROM App\Entity\Posts p JOIN p.Category c WHERE c.id = :categoryId';
        // $query = $entityManager->createQuery($dql);
        // $query->setParameter('categoryId', $categoryId);
        // $posts = $query->getResult();

        $category = $categoryRepository->findAllCategory();
        $SubCategory = $SubCategoryRepository->findAllSubCategory();

        // $dql = 'SELECT c FROM App\Entity\Category c';
        // $query = $entityManager->createQuery($dql);
        // $categories = $query->getResult();

        return $this->render('posts/index.html.twig', [
            'posts' => $posts,
            'category' => $category,
            'categoryId' => $categoryId,
            'SubCategory' => $SubCategory,
        ]);
    }

    #[Route('/tags/{tagId}', name: 'app_posts_by_tag', methods: ['GET'])]
    public function filterByTags(
        EntityManagerInterface $entityManager, int $tagId, CategoryRepository $categoryRepository, PostsRepository $postRepository, TagsRepository $tagRepository): Response
    {

        // $posts = $postRepository->createQueryBuilder('p')
        // ->innerJoin('p.Tags', 't')  // Join tra i post e i tag
        // ->where('t.id = :tagId')  // Condizione per il tagId
        // ->setParameter('tagId', $tagId)  // Impostiamo il parametro tagId
        // ->getQuery()
        // ->getResult();

        $dql = 'SELECT p 
        FROM App\Entity\Posts p 
        JOIN p.Tags t 
        WHERE t.id = :tagId';

$query = $entityManager->createQuery($dql);
$query->setParameter('tagId', $tagId);

$posts = $query->getResult();

    $tags = $tagRepository->findAll();
    $category = $categoryRepository->findAllCategory();
    
        return $this->render('posts/index.html.twig', [
            'posts' => $posts,
            'tags' => $tags,
            'category' => $category,
        ]);
    }
    
}
