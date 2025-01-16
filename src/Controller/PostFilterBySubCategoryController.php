<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/posts')]
final class PostFilterBySubCategoryController extends AbstractController
{
    #[Route('/category/subcategory/{subcategoryId}', name: 'app_posts_by_category_subcategory', methods: ['GET'])]
    public function filterBySubCategory(
        int $subcategoryId,
        PostsRepository $postRepository,
        CategoryRepository $categoryRepository,
        SubCategoryRepository $subCategoryRepository
    ): Response {
        
        $posts = $postRepository->findBy(['subcategory' => $subcategoryId]);

        $category = $categoryRepository->findAll();
        $SubCategory = $subCategoryRepository->findAll();

        return $this->render('posts/index.html.twig', [
            'posts' => $posts,
            'category' => $category,
            'categoryId' => $subcategoryId,
            'SubCategory' => $SubCategory,
        ]);
    }
}
