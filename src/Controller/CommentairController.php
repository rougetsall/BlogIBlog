<?php

namespace App\Controller;

use App\Entity\Commentair;
use App\Form\CommentairType;
use App\Repository\CommentairRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentair")
 */
class CommentairController extends AbstractController
{
    /**
     * @Route("/", name="commentair_index", methods={"GET"})
     */
    public function index(CommentairRepository $commentairRepository): Response
    {
        return $this->render('commentair/index.html.twig', [
            'commentairs' => $commentairRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commentair_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commentair = new Commentair();
        $form = $this->createForm(CommentairType::class, $commentair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentair);
            $entityManager->flush();

            return $this->redirectToRoute('commentair_index');
        }

        return $this->render('commentair/new.html.twig', [
            'commentair' => $commentair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentair_show", methods={"GET"})
     */
    public function show(Commentair $commentair): Response
    {
        return $this->render('commentair/show.html.twig', [
            'commentair' => $commentair,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commentair_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commentair $commentair): Response
    {
        $form = $this->createForm(CommentairType::class, $commentair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentair_index');
        }

        return $this->render('commentair/edit.html.twig', [
            'commentair' => $commentair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commentair_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commentair $commentair): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentair->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commentair);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commentair_index');
    }
}
