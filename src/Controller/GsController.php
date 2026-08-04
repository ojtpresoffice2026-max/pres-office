<?php

namespace App\Controller;

use App\Entity\Gs;
use App\Form\GsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gs')]
final class GsController extends AbstractController
{
    #[Route(name: 'app_gs_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $gs = $entityManager
            ->getRepository(Gs::class)
            ->findAll();

        return $this->render('gs/index.html.twig', [
            'gs' => $gs,
        ]);
    }

    #[Route('/new', name: 'app_gs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $g = new Gs();
        $form = $this->createForm(GsType::class, $g);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($g);
            $entityManager->flush();

            return $this->redirectToRoute('app_gs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gs/new.html.twig', [
            'g' => $g,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gs_show', methods: ['GET'])]
    public function show(Gs $g): Response
    {
        return $this->render('gs/show.html.twig', [
            'g' => $g,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gs $g, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GsType::class, $g);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gs/edit.html.twig', [
            'g' => $g,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gs_delete', methods: ['POST'])]
    public function delete(Request $request, Gs $g, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$g->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($g);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gs_index', [], Response::HTTP_SEE_OTHER);
    }
}
