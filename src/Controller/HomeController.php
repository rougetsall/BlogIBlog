<?php

namespace App\Controller;
use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BlogPostRepository $blogPostRepository): Response
    { 
        
        return $this->render('home/index.html.twig', [
            'blog_posts' => $blogPostRepository->findlimite(),
        ]);
        
    }
}
