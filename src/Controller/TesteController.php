<?php

namespace App\Controller;

use App\Entity\Teste;
use App\Form\TesteType;
use App\Repository\TesteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/teste")
 */
class TesteController extends AbstractController
{
    /**
     * @Route("/", name="teste_index", methods={"GET"})
     */
    public function index(TesteRepository $testeRepository): Response
    {
        return $this->render('teste/index.html.twig', [
            'testes' => $testeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="teste_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $teste = new Teste();
        $form = $this->createForm(TesteType::class, $teste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($teste);
            $entityManager->flush();

            return $this->redirectToRoute('teste_index');
        }

        return $this->render('teste/new.html.twig', [
            'teste' => $teste,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="teste_show", methods={"GET"})
     */
    public function show(Teste $teste): Response
    {
        return $this->render('teste/show.html.twig', [
            'teste' => $teste,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="teste_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Teste $teste): Response
    {
        $form = $this->createForm(TesteType::class, $teste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teste_index');
        }

        return $this->render('teste/edit.html.twig', [
            'teste' => $teste,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="teste_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Teste $teste): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teste->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($teste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('teste_index');
    }
}
