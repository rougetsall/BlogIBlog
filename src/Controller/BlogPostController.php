<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use App\Repository\UserRepository;
use App\Entity\Commentair;
use App\Form\CommentairFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/blog/post")
 */
class BlogPostController extends AbstractController
{
    /**
     * @Route("/", name="blog_post_index", methods={"GET"})
     */
    public function index(BlogPostRepository $blogPostRepository): Response
    {
        if(in_array('ROLE_ADMIN', $this->getUser()->getRoles()))
        { 
            return $this->render('blog_post/index.html.twig', [
                'blog_posts' => $blogPostRepository->findAll(),
            ]);
           
          
          
        }
        elseif(in_array('ROLE_USER', $this->getUser()->getRoles()))
        {
            return $this->render('blog_post/index.html.twig', [
                'blog_posts' => $blogPostRepository->findBy(
                    ["author"=>$this->getUser()->getName()],
                    ['id' => 'DESC'])
                
            ]);
        }
        else{
            return $this->redirectToRoute('blog_post_index');
            
        }
        
    }

     /**
     * @Route("auth/{author}", name="blog_post_index_author", methods={"GET"})
     */
    public function authors(BlogPostRepository $blogPostRepository,$author,$limit = 10): Response
    {
      
            return $this->render('blog_post/index.html.twig', [
                'blog_posts' => $blogPostRepository->findBy(
                    ["author"=>$author],
                    ['id' => 'DESC'],
                    $limit)
                
            ]);
    }
    /**
     * @Route("/new", name="blog_post_new", methods={"GET","POST"})
     */
    public function new(Request $request,Security $security): Response
    {
        $blogPost = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);
        $blogPost->setAuthor($security->getUser()->getName());
        $blogPost->setUserid($security->getUser());
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPost);
            $entityManager->flush();

            return $this->redirectToRoute('blog_post_index');
        }

        return $this->render('blog_post/new.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_post_show", methods={"GET","POST"})
     */
    public function show(Request $request,BlogPost $blogPost,UserRepository $userRepository): Response
    { 

        $message = new Commentair();
        $message->setIdblogiblog($blogPost);
        $form = $this->createForm(CommentairFormType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->persist($blogPost);
            $entityManager->flush();
            return $this->redirectToRoute('blog_post_show', ['id' => $blogPost->getId()]);
        }
        return $this->render('blog_post/show.html.twig', [
            'blog_post' => $blogPost,
            'nameuser'=>$this->getUser()->getName(),
            'user'     => $userRepository->findBy(
                ["name"=>$blogPost->getAuthor()]),
                //'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}/edit", name="blog_post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BlogPost $blogPost): Response
    {
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_post_index');
        }

        return $this->render('blog_post/edit.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BlogPost $blogPost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blogPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog_post_index');
    }
}
