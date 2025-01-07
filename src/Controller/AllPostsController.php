<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use App\Repository\CategoryRepository;
use App\Repository\TagsRepository;

use App\Entity\tags;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

use Doctrine\ORM\Query\ResultSetMapping;


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

    #[Route('/category/{categoryId}', name: 'app_posts_by_category', methods: ['GET'])]
    public function filterByCategory(int $categoryId, PostsRepository $postRepository, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response
    {
        
        $posts = $postRepository->findBy(['Category' => $categoryId]);

        // $dql = 'SELECT p FROM App\Entity\Posts p JOIN p.Category c WHERE c.id = :categoryId';
        // $query = $entityManager->createQuery($dql);
        // $query->setParameter('categoryId', $categoryId);
        // $posts = $query->getResult();

        $category = $categoryRepository->findAllCategory();

        // $dql = 'SELECT c FROM App\Entity\Category c';
        // $query = $entityManager->createQuery($dql);
        // $categories = $query->getResult();

        return $this->render('posts/index.html.twig', [
            'posts' => $posts,
            'category' => $category,
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
    public function show(Posts $post): Response
    {
        return $this->render('posts/show.html.twig', [
            'post' => $post,
        ]);
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edit', name: 'app_posts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
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
    public function delete(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
