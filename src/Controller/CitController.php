<?php

namespace App\Controller;

use App\Entity\Cit;
use App\Form\CitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cit')]
final class CitController extends AbstractController
{
    #[Route(name: 'app_cit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cits = $entityManager
            ->getRepository(Cit::class)
            ->findAll();

        return $this->render('cit/index.html.twig', [
            'cits' => $cits,
        ]);
    }

    #[Route('/new', name: 'app_cit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cit = new Cit();
        $form = $this->createForm(CitType::class, $cit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cit);
            $entityManager->flush();

            return $this->redirectToRoute('app_cit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cit/new.html.twig', [
            'cit' => $cit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cit_show', methods: ['GET'])]
    public function show(Cit $cit): Response
    {
        return $this->render('cit/show.html.twig', [
            'cit' => $cit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cit $cit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CitType::class, $cit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cit/edit.html.twig', [
            'cit' => $cit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cit_delete', methods: ['POST'])]
    public function delete(Request $request, Cit $cit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cit_index', [], Response::HTTP_SEE_OTHER);
    }
}
