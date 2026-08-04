<?php

namespace App\Controller;

use App\Entity\Col;
use App\Form\ColType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/col')]
final class ColController extends AbstractController
{
    #[Route(name: 'app_col_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cols = $entityManager
            ->getRepository(Col::class)
            ->findAll();

        return $this->render('col/index.html.twig', [
            'cols' => $cols,
        ]);
    }

    #[Route('/new', name: 'app_col_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $col = new Col();
        $form = $this->createForm(ColType::class, $col);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($col);
            $entityManager->flush();

            return $this->redirectToRoute('app_col_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('col/new.html.twig', [
            'col' => $col,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_col_show', methods: ['GET'])]
    public function show(Col $col): Response
    {
        return $this->render('col/show.html.twig', [
            'col' => $col,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_col_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Col $col, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ColType::class, $col);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_col_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('col/edit.html.twig', [
            'col' => $col,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_col_delete', methods: ['POST'])]
    public function delete(Request $request, Col $col, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$col->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($col);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_col_index', [], Response::HTTP_SEE_OTHER);
    }
}
