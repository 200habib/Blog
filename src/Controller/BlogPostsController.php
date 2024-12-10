<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogPostsController extends AbstractController
{
    #[Route('/blog/posts', name: 'app_blog_posts')]
    public function index(): Response
    {
        return $this->render('blog_posts/index.html.twig', [
            'controller_name' => 'BlogPostsController',
        ]);
    }
}
