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
final class PostFilterByCategoryController extends AbstractController
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
    
}
