<?php

namespace App\Controller;

use App\Entity\Gs;
use App\Form\GsType;
use App\Repository\GsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gs')]
final class GsController extends AbstractController
{
    #[Route(name: 'app_gs_index', methods: ['GET'])]
    public function index(GsRepository $gsRepository): Response
    {
        return $this->render('gs/index.html.twig', [
            'gss' => $gsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gs = new Gs();
        $form = $this->createForm(GsType::class, $gs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gs);
            $entityManager->flush();

            return $this->redirectToRoute('app_gs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gs/new.html.twig', [
            'gs' => $gs,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gs_show', methods: ['GET'])]
    public function show(Gs $gs): Response
    {
        return $this->render('gs/show.html.twig', [
            'gs' => $gs,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gs $gs, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GsType::class, $gs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gs/edit.html.twig', [
            'gs' => $gs,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gs_delete', methods: ['POST'])]
    public function delete(Request $request, Gs $gs, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gs->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($gs);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gs_index', [], Response::HTTP_SEE_OTHER);
    }
}
