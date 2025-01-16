<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use App\Repository\CategoryRepository;
use App\Entity\Website;

use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/posts')]
final class AllPostsController extends AbstractController
{
    #[Route(name: 'app_posts_index', methods: ['GET'])]
    public function index(PostsRepository $postRepository, CategoryRepository $categoryRepository): Response
    {

        $posts = $postRepository->findAllPosts();

        $category = $categoryRepository->findAllCategory();

        return $this->render('posts/index.html.twig', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }    

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'app_posts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->updateTimestamp();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posts_show', methods: ['GET'])]
    public function show(Posts $post, 
    EntityManagerInterface $entityManager, 
    Security $security): Response
    {
        $user = $security->getUser();
        
        $Websites = $entityManager
        ->getRepository(Website::class)
        ->findBy(['user' => $user]);

        return $this->render('posts/show.html.twig', [
            'post' => $post,
            'Website' => $Websites,
        ]);
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edit', 
    name: 'app_posts_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request, 
        Posts $post, 
        EntityManagerInterface $entityManager
        ): Response
    {
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/{id}', name: 'app_posts_delete', methods: ['POST'])]
    public function delete(Request $request, 
    Posts $post, 
    EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), 
        $request->getPayload()->getString('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_posts_index', 
        [], Response::HTTP_SEE_OTHER);
    }
}
