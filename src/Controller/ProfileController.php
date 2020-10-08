<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Component\Security\Core\Security;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile", methods={"GET"})
     */
    public function index(BlogPostRepository $blogPostRepository,UserRepository $userRepository,$limit = 5): Response
    {
        return $this->render('profile/index.html.twig', [
            'user' => $userRepository->findBy(
                ["name"=>$this->getUser()->getName()]),
            'blog_posts' => $blogPostRepository->findBy(
                ["author"=>$this->getUser()->getName()],
                ['id' => 'DESC'],
                $limit),

            'controller_name' => 'ProfileController',
        ]);
    }
}
